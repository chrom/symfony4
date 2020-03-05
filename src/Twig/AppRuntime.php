<?php

declare(strict_types=1);

namespace App\Twig;


use App\Services\MarkdownHelper;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{
    private $markdownHelper;

    public function __construct(MarkdownHelper $markdownHelper)
    {
        $this->markdownHelper = $markdownHelper;
    }

    public function processMarkdown($value)
    {
        return $this->markdownHelper->parse($value);
    }
}
