<?php

/*
 * (c) 2016 Vocento S.A., <desarrollo.dts@vocento.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Voc\AMPBundle\Sanitizer;

/**
 * @author Ariel Ferrandini <aferrandini@vocento.com>
 * @author Laura Garcia Rivas <lgarciari@vocento.com>
 */
class Sanitizer implements SanitizerInterface
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
        // '<style>',

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
        //'<source>',

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
        '<amp-image-lightbox>'

    );

    /**
     * Disallowed ATTRIBUTES
     *
     * https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md
     */
    const DISALLOWED_ATTRIBUTES = array(
        'style',
        'datetime',
        'cite',
        'channel',
		'summary',
        'onclick',
        'target',
        'cellspacing',
        'border',
        'data-src'
    );

    /**
     * Disallowed ATTRIBUTES with a value
     *
     * https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md
     */
    const DISALLOWED_ATTRIBUTES_WITH_VALUE = array(
        'target' => '_top',
		'href' => 'file:'
    );

    /**
     * Disallowed ATTRIBUTE value
     *
     * https://github.com/ampproject/amphtml/blob/master/spec/amp-tag-addendum.md
     */
    const DISALLOWED_ATTRIBUTES_VALUE = array(
        'rel' => 'stylesheet'
    );

    /**
     * @inheritDoc
     */
    public function sanitize($html)
    {
        // Remove disallowed tags
        $html = strip_tags($html, implode('', self::ALLOWED_TAGS));

        // Remove disallowed attributes
        foreach (self::DISALLOWED_ATTRIBUTES as $attribute) {
            $html = preg_replace('/ ' . $attribute . '=\\"[^\\"]*\\"/', '', $html);
        }

        // Remove disallowed attributes with value
        foreach (self::DISALLOWED_ATTRIBUTES_WITH_VALUE as $attribute => $value) {
            $html = preg_replace('/ ' . $attribute . "=['|\"]" . $value . "['|\"]*/", '', $html);
        }

        // Remove disallowed attributes values
        foreach (self::DISALLOWED_ATTRIBUTES_VALUE as $attribute => $value) {
            $html = preg_replace('/ ' . $attribute . "=['|\"]" . $value . "['|\"]/", ' ' . $attribute . '=""', $html);
        }

        return $html;
    }
}