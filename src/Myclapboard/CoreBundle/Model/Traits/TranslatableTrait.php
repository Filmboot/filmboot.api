<?php

namespace Myclapboard\CoreBundle\Model\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * Trait for translatable elements.
 *
 * @package Myclapboard\CoreBundle\Model\Traits
 */
trait TranslatableTrait
{
    /**
     * @var ArrayCollection
     */
    protected $translations;

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function removeTranslation(AbstractPersonalTranslation $translation)
    {
        $this->translations->removeElement($translation);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTranslations()
    {
        return $this->translations;
    }
} 