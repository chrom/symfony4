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
    private $markdown;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var bool
     */
    private $isDebug;

    /**
     * MarkdownHelper constructor.
     * @param AdapterInterface $cache
     * @param MarkdownParserInterface $markdownHelper
     * @param LoggerInterface $markdownLogger
     * @param bool $isDebug
     */
    public function __construct(AdapterInterface $cache, MarkdownParserInterface $markdownHelper, LoggerInterface $markdownLogger, bool $isDebug)
    {
        $this->cache = $cache;
        $this->markdown = $markdownHelper;
        $this->logger = $markdownLogger;
        $this->isDebug = $isDebug;
    }

    public function parse(string $source): string
    {
        if(stripos($source, 'bacon')){
            $this->logger->info('The bacon again!');
        }

        if($this->isDebug){
            return $this->markdown->transform($source);
        }

        $item = $this->cache->getItem('markdown_' . md5($source));
        if (!$item->isHit()){
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }
        return $item->get();
    }
}
