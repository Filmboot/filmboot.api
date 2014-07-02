<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\AwardBundle\Entity;

use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * Class CategoryTranslation.
 *
 * @package Filmbot\AwardBundle\Entity
 */
class CategoryTranslation extends AbstractPersonalTranslation
{
    /**
     * Constructor.
     *
     * @param string $locale  The locale
     * @param string $field   The name of field
     * @param string $content The content of field
     */
    public function __construct($locale, $field, $content)
    {
        $this->setLocale($locale);
        $this->setField($field);
        $this->setContent($content);
    }

    protected $object;
}
