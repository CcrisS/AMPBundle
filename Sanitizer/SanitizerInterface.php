<?php
/**
 * SanitizerInterface.php
 *
 * Ariel Ferrandini <arielferrandini@gmail.com>
 * 04/02/16
 */
namespace Voc\AMPBundle\Sanitizer;

interface SanitizerInterface
{
    /**
     * Sanitizes HTML
     *
     * @param $html
     * @return string
     */
    public function sanitize($html);
}