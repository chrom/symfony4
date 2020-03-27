<?php

declare(strict_types=1);


namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * @author Henrik Bjornskov <hb@peytz.dk>
 */
class TextExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('truncate', [AppRuntime::class, 'twig_truncate_filter'], ['needs_environment' => true]),
            new TwigFilter('wordwrap', [AppRuntime::class, 'twig_wordwrap_filter'], ['needs_environment' => true]),
        ];
    }
}
