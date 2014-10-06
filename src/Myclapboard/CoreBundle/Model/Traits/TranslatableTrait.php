<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model\Traits;

use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * Trait TranslatableTrait.
 *
 * @package Myclapboard\CoreBundle\Model\Traits
 */
trait TranslatableTrait
{
    /**
     * Array that contains translations.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $translations;

    /**
     * Adds translation.
     *
     * @param \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation $translation The translation
     *
     * @return self $this object
     */
    public function addTranslation(AbstractPersonalTranslation $translation)
    {
        if ($this->translations->contains($translation) === false) {
            $this->translations[] = $translation;
            $translation->setObject($this);
        }

        return $this;
    }

    /**
     * Removes translation.
     *
     * @param \Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation $translation The translation
     *
     * @return self $this object
     */
    public function removeTranslation(AbstractPersonalTranslation $translation)
    {
        $this->translations->removeElement($translation);

        return $this;
    }

    /**
     * Gets array of translations.
     *
     * @return array<\Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation>
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}
