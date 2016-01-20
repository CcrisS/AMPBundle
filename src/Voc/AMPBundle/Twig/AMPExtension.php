<?php
/**
 * AMPExtension.php
 *
 * Ariel Ferrandini <arielferrandini@gmail.com>
 * 13/01/16
 */
namespace Voc\AMPBundle\Twig;

class AMPExtension extends \Twig_Extension
{
    /**
     * Allowed TAGS getted from
     *
     * https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md
     */
    const ALLOWED_TAGS = array(
         // The root element
        '<html>',

        // Document metadata
        '<head>',
        '<title>',
        '<link>',
        '<meta>',
        '<style>',

        // Sections
        '<body>',
        '<article>',
        '<section>',
        '<nav>',
        '<aside>',
        '<h1>',
        '<h2>',
        '<h3>',
        '<h4>',
        '<h5>',
        '<h6>',
        '<header>',
        '<footer>',
        '<address>',

        // Grouping Content
        '<p>',
        '<hr>',
        '<pre>',
        '<blockquote>',
        '<ol>',
        '<ul>',
        '<li>',
        '<dl>',
        '<dt>',
        '<dd>',
        '<figure>',
        '<figcaption>',
        '<div>',
        '<main>',

        // Text-level semantics
        '<a>',
        '<em>',
        '<strong>',
        '<small>',
        '<s>',
        '<cite>',
        '<q>',
        '<dfn>',
        '<abbr>',
        '<data>',
        '<time>',
        '<code>',
        '<var>',
        '<samp>',
        '<kbd>',
        '<sub>',
        '<sup>',
        '<i>',
        '<b>',
        '<u>',
        '<mark>',
        '<ruby>',
        '<rb>',
        '<rt>',
        '<rtc>',
        '<rp>',
        '<bdi>',
        '<bdo>',
        '<span>',
        '<br>',
        '<wb>',

        // Edits
        '<insert>',
        '<del>',

        // Embedded Content
        '<source>',

        // SVG
        '<svg>',
        '<g>',
        '<path>',
        '<glyph>',
        '<glyphref>',
        '<marker>',
        '<view>',
        '<circle>',
        '<line>',
        '<polygon>',
        '<polyline>',
        '<rect>',
        '<text>',
        '<textpath>',
        '<tref>',
        '<tspan>',
        '<clippath>',
        '<filter>',
        '<lineargradient>',
        '<radialgradient>',
        '<mask>',
        '<pattern>',
        '<vkern>',
        '<hkern>',
        '<defs>',
        '<use>',
        '<symbol>',
        '<desc>',
        '<title>',

        // Links
        // Tabular data
        '<table>',
        '<caption>',
        '<colgroup>',
        '<col>',
        '<tbody>',
        '<thead>',
        '<tfoot>',
        '<tr>',
        '<td>',
        '<th>',

        // Forms
        '<button>',

        // Amp Specific Tags
        '<amp-img>',
        '<amp-video>',
        '<amp-ad>',
        '<amp-fit-text>',
        '<amp-font>',
        '<amp-carousel>',
        '<amp-anim>',
        '<amp-youtube>',
        '<amp-twitter>',
        '<amp-vine>',
        '<amp-instagram>',
        '<amp-iframe>',
        '<amp-pixel>',
        '<amp-audio>',
        '<amp-lightbox>',
        '<amp-image-lightbox>',
    );

    /**
     * @inheritDoc
     */
    public function getFilters()
    {
        return array(
            'removeDisallowedAMPTags' => new \Twig_Filter_Method($this, 'removeDisallowedAMPTags'),
        );
    }


    /**
     * Removes the disallowed tags by AMP
     *
     * @param $html
     * @return string
     */
    public function removeDisallowedAMPTags($html)
    {
        return strip_tags($html, $this->getAllowedTags());
    }

    /**
     * @return string
     */
    private function getAllowedTags()
    {
        return implode('', self::ALLOWED_TAGS);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'amp';
    }
}
