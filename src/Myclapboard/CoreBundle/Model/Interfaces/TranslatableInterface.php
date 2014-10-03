<?php

namespace Myclapboard\CoreBundle\Model\Interfaces;

use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * Interface TranslatableInterface.
 *
 * @package Myclapboard\CoreBundle\Model\Interfaces
 */
interface TranslatableInterface
{
    /**
     * Gets array of translations.
     *
     * @return array<\Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation $translation The translation
     *
     * @return self $this object
     */
    public function addTranslation(AbstractPersonalTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation $translation The translation
     *
     * @return self $this object
     */
    public function removeTranslation(AbstractPersonalTranslation $translation);

} 