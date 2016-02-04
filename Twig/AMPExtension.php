<?php
/**
 * AMPExtension.php
 *
 * Ariel Ferrandini <arielferrandini@gmail.com>
 * 13/01/16
 */
namespace Voc\AMPBundle\Twig;


use Voc\AMPBundle\Sanitizer\SanitizerInterface;

class AMPExtension extends \Twig_Extension
{
    /** @var SanitizerInterface */
    protected $sanitizer;

    /**
     * AMPExtension constructor.
     *
     * @param SanitizerInterface $sanitizer
     */
    public function __construct(SanitizerInterface $sanitizer)
    {
        $this->sanitizer = $sanitizer;
    }

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
        return $this->sanitizer->sanitize($html);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'amp';
    }
}
