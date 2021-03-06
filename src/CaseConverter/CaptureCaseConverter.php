<?php

declare(strict_types=1);

namespace Symplify\LatteToTwigConverter\CaseConverter;

use Nette\Utils\Strings;
use Symplify\LatteToTwigConverter\Contract\CaseConverter\CaseConverterInterface;

final class CaptureCaseConverter implements CaseConverterInterface
{
    public function getPriority(): int
    {
        return 900;
    }

    public function convertContent(string $content): string
    {
        // {var $var = $anotherVar} =>
        // {% set var = anotherVar %}
        $content = Strings::replace($content, '#{var \$?(.*?) = \$?(.*?)}#s', '{% set $1 = $2 %}');

        // {capture $var}...{/capture} =>
        // {% set var %}...{% endset %}
        return Strings::replace($content, '#{capture \$(\w+)}(.*?){\/capture}#s', '{% set $1 %}$2{% endset %}');
    }
}
