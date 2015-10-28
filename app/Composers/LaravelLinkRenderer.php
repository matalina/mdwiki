<?php
namespace App\Composers;

use League\CommonMark\Inline\Renderer\InlineRendererInterface;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Link;

class LaravelLinkRenderer implements InlineRendererInterface
{

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof Link)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }
        
        $attrs = [];
        foreach ($inline->getData('attributes', []) as $key => $value) {
            $attrs[$key] = $htmlRenderer->escape($value, true);
        }
        
        $attrs['href'] = $htmlRenderer->escape(url($inline->getUrl()), true);
        
        if (isset($inline->data['title'])) {
            $attrs['title'] = $htmlRenderer->escape($inline->data['title'], true);
        }
        
        return new HtmlElement('a', $attrs, $htmlRenderer->renderInlines($inline->children()));
    }
}