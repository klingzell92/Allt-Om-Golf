<?php
namespace Anax\TextFilter;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Michelf\MarkdownExtra;
use \Michelf\SmartyPantsTypographer;

/**
 * Filter and format content.
 *
 */
class TextFilter implements InjectionAwareInterface
{
    use TTextUtilities,
        TShortcode,
        InjectionAwareTrait;

    /**
     * Format text according to Markdown syntax.
     *
     * @param string $text the text that should be formatted.
     *
     * @return string as the formatted html-text.
     */
    public function markdown($text)
    {
        $markdownExtra = new MarkdownExtra();
        $smartyPantsTypo = new SmartyPantsTypographer();
        $text = $markdownExtra->defaultTransform($text);
        $text = $smartyPantsTypo->defaultTransform(
            $text,
            "2"
        );
        return $text;
    }

    /**
     * For convenience access to htmlentities
     *
     * @param string $text text to be converted.
     *
     * @return string the formatted text.
     */
    public function htmlentities($text)
    {
        return htmlentities($text);
    }
}
