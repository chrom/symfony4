<?php

declare(strict_types=1);


namespace App\Servise;


use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    /**
     * @var AdapterInterface
     */
    private $cache;
    /**
     * @var MarkdownHelper
     */
    private $markdownHelper;

    /**
     * MarkdownHelper constructor.
     * @param AdapterInterface $cache
     * @param MarkdownHelper $markdownHelper
     */
    public function __construct(AdapterInterface $cache, MarkdownHelper $markdownHelper)
    {
        $this->cache = $cache;
        $this->markdownHelper = $markdownHelper;
    }

    public function parse(string $source): string
    {
        $item = $this->cache->getItem('markdown_' . md5($source));
        if (!$item->isHit()){
            $item->set($this->markdownHelper->transform($source));
            $this->cache->save($item);
        }
        return $item->get();
    }
}
