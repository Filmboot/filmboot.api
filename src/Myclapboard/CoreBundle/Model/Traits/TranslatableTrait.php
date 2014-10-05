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
     * @var \Doctrine\Common\Collections\ArrayCollection
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
