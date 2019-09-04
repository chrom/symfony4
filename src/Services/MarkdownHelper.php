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
     * @param MarkdownParserInterface $markdownHelper
     * @param LoggerInterface $markdownLogger
     */
    public function __construct(AdapterInterface $cache, MarkdownParserInterface $markdownHelper, LoggerInterface $markdownLogger)
    {
        $this->cache = $cache;
        $this->markdownHelper = $markdownHelper;
        $this->logger = $markdownLogger;
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
