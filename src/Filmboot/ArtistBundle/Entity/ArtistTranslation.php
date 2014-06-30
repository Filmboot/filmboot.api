<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\ArtistBundle\Entity;

use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * Class ArtistTranslation.
 *
 * @package Filmboot\ArtistBundle\Entity
 */
class ArtistTranslation extends AbstractPersonalTranslation
{
    /**
     * Constructor.
     *
     * @param string $locale
     * @param string $field
     * @param string $content
     */
    public function __construct($locale, $field, $content)
    {
        $this->setLocale($locale);
        $this->setField($field);
        $this->setContent($content);
    }

    protected $object;
}
