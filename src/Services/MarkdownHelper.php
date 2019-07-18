<?php

declare(strict_types=1);


namespace App\Services;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * MarkdownHelper constructor.
     * @param AdapterInterface $cache
     * @param MarkdownHelper $markdownHelper
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(AdapterInterface $cache, MarkdownParserInterface $markdownHelper, LoggerInterface $logger)
    {
        $this->cache = $cache;
        $this->markdownHelper = $markdownHelper;
        $this->logger = $logger;
    }

    public function parse(string $source): string
    {
        if(stripos($source, 'bacon')){
            $this->logger->info('The bacon again!');
        }
        $item = $this->cache->getItem('markdown_' . md5($source));
        if (!$item->isHit()){
            $item->set($this->markdownHelper->transform($source));
            $this->cache->save($item);
        }
        return $item->get();
    }
}
