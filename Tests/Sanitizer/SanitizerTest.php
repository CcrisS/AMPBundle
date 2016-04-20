<?php
/**
 * SanitizerTest.php
 *
 * Ariel Ferrandini <arielferrandini@gmail.com>
 * 04/02/16
 */
namespace Voc\AMPBundle\Tests;

use Voc\AMPBundle\Sanitizer\Sanitizer;

class SanitizerTest extends \PHPUnit_Framework_TestCase
{
    /** @var Sanitizer */
    private $sanitizer;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->sanitizer = new Sanitizer();
    }

    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->sanitizer = null;
    }

    /**
     * @dataProvider getInvalidHTMLTags
     */
    public function testSanitizeInvalidHTMLTags($html, $expected)
    {
        $this->assertEquals($expected, $this->sanitizer->sanitize($html));
    }

    /**
     * @dataProvider getInvalidHTMLAttributes
     */
    public function testSanitizeInvalidHTMLAttributes($html, $expected)
    {
        $this->assertEquals($expected, $this->sanitizer->sanitize($html));
    }

    /**
     * @dataProvider getInvalidHTMLAttributesWithValue
     */
    public function testSanitizeInvalidHTMLAttributesWithValue($html, $expected)
    {
        $this->assertEquals($expected, $this->sanitizer->sanitize($html));
    }

    /**
     * @dataProvider getInvalidHTMLAttributeValue
     */
    public function testSanitizeInvalidHTMLAttributeValue($html, $expected)
    {
        $this->assertEquals($expected, $this->sanitizer->sanitize($html));
    }

    public function getInvalidHTMLTags()
    {
        $cases = array();

        array_push(
            $cases,
            array('<html><head></head><body><img></img></body></html>', '<html><head></head><body></body></html>')
        );
        array_push(
            $cases, array(
                '<html><head></head><body><amp-img></amp-img></body></html>',
                '<html><head></head><body><amp-img></amp-img></body></html>'
            )
        );
        array_push(
            $cases, array(
                '<html><head></head><body><img></img><p><amp-img></amp-img></p></body></html>',
                '<html><head></head><body><p><amp-img></amp-img></p></body></html>'
            )
        );

        return $cases;
    }

    public function getInvalidHTMLAttributes()
    {
        $cases = array();

        foreach (Sanitizer::DISALLOWED_ATTRIBUTES as $attribute) {
            array_push(
                $cases, array(
                    '<html><head></head><body><p ' . $attribute . '="valor">content</p></body></html>',
                    '<html><head></head><body><p>content</p></body></html>'
                )
            );
        }

        return $cases;
    }

    public function getInvalidHTMLAttributesWithValue()
    {
        $cases = array();

        foreach (Sanitizer::DISALLOWED_ATTRIBUTES_WITH_VALUE as $attribute => $value) {
            array_push(
                $cases, array(
                    '<html><head></head><body><p ' . $attribute .'="' . $value .'">content</p></body></html>',
                    "<html><head></head><body><p>content</p></body></html>"
                )
            );
            array_push(
                $cases, array(
                    '<html><head></head><body><p ' . $attribute .'=\'' . $value .'\'>content</p></body></html>',
                    "<html><head></head><body><p>content</p></body></html>"
                )
            );
        }

        return $cases;
    }

    public function getInvalidHTMLAttributeValue()
    {
        $cases = array();

        foreach (Sanitizer::DISALLOWED_ATTRIBUTES_VALUE as $attribute => $value) {
            array_push(
                $cases, array(
                    '<html><head></head><body><p ' . $attribute . '=\'' . $value .'\'>content</p></body></html>',
                    '<html><head></head><body><p ' . $attribute . '="">content</p></body></html>'
                )
            );
            array_push(
                $cases, array(
                    '<html><head></head><body><p ' . $attribute . '="' . $value .'">content</p></body></html>',
                    '<html><head></head><body><p ' . $attribute . '="">content</p></body></html>'
                )
            );
        }

        return $cases;
    }
}
