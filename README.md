# Latte to Twig Converter

[![Build Status Github Actions](https://img.shields.io/github/workflow/status/Symplify/LatteToTwigConverter/Code_Checks?style=flat-square)](https://github.com/Symplify/LatteToTwigConverter/actions)
[![Downloads total](https://img.shields.io/packagist/dt/symplify/latte-to-twig-converter.svg?style=flat-square)](https://packagist.org/packages/symplify/latte-to-twig-converter/stats)

Do you want to turn your [Latte](https://latte.nette.org/en/) templates to [Twig](https://twig.symfony.com/)?

**Before**

```html
{foreach $values as $key => $value}
    {$value->getName()}

    {if isset($value['position'])}
        {$value['position']|noescape}
    {else}
        {var $noPosition = true}
    {/if}
{/foreach}
```

**After**

```twig
{% for key, value in values %}
    {{ value.getName() }}

    {% if value.position is defined %}
        {{ value.position|raw }}
    {% else %}
        {% set noPosition = true %}
    {% endif %}
{% endfor %}
```

And much more!

This package won't do it all for you, but **it will help you with 80 % of the boring work**.

## Install

```bash
composer require symplify/latte-to-twig-converter --dev
```

## Usage

It scan all the `*.twig`/`*.latte` files and converts to Twig with `*.twig`.

```bash
vendor/bin/latte-to-twig-converter convert file.twig
vendor/bin/latte-to-twig-converter convert /directory
```

## Handle These Cases to Manually

Some code doesn't have a clear path - you have more options in Twig, so better to migrate it manually.

### `continueIf`

```diff
-{continueIf $cond}
+{% if cond %}
-{$value}
+    {{ value }}
+{% endif %}
```

### `breakIf`

```diff
-{breakIf $cond}
+{% if cond === false %}
-{$value}
+    {{ value }}
+{% endif %}
```

That's it :)
