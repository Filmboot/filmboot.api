<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\MovieBundle\Entity;

use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * Class GenreTranslation.
 *
 * @package Myclapboard\MovieBundle\Entity
 */
class GenreTranslation extends AbstractPersonalTranslation
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
