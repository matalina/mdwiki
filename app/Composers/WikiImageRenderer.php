<?php namespace App\Composers;

use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Image;

class WikiImageRenderer implements InlineRendererInterface
{
    /**
     * @param Image                    $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return HtmlElement
     */
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof Image)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }
        
        $attrs = [];
        foreach ($inline->getData('attributes', []) as $key => $value) {
            $attrs[$key] = $htmlRenderer->escape($value, true);
        }
        
        $attrs['src'] = $htmlRenderer->escape(route('image',['filename' => $inline->getUrl()]), true);
        
        $alt = $htmlRenderer->renderInlines($inline->children());
        
        $alt = preg_replace('/\<[^>]*alt="([^"]*)"[^>]*\>/', '$1', $alt);
        
        $attrs['alt'] = preg_replace('/\<[^>]*\>/', '', $alt);
        
        if (isset($inline->data['title'])) {
            $attrs['title'] = $htmlRenderer->escape($inline->data['title'], true);
        }
        
        return new HtmlElement('img', $attrs, '', true);
    }
}