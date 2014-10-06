<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\ArtistBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface;
use Myclapboard\ArtistBundle\Model\Interfaces\ImageInterface;
use Myclapboard\CoreBundle\Model\Traits\HumanTrait;
use Myclapboard\CoreBundle\Model\Traits\MediaTrait;
use Myclapboard\CoreBundle\Model\Traits\RolesTrait;
use Myclapboard\CoreBundle\Model\Traits\TranslatableTrait;
use Myclapboard\MovieBundle\Util\Util;

/**
 * Class Artist model.
 *
 * @package Myclapboard\ArtistBundle\Model
 */
class Artist implements ArtistInterface
{
    use HumanTrait;
    use MediaTrait;
    use RolesTrait;
    use TranslatableTrait;

    /**
     * The id.
     *
     * @var string
     */
    protected $id;

    /**
     * Array that contains images.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $images;

    /**
     * The slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();

        $this->actors = new ArrayCollection();
        $this->directors = new ArrayCollection();
        $this->writers = new ArrayCollection();

        $this->translations = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function addImage(ImageInterface $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ImageInterface $image)
    {
        $this->images->removeElement($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug()
    {
        $this->slug = Util::getSlug($this->__toString());

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return self::setSlug();
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return self::setSlug();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        if (!$this->getFirstName() || !$this->getLastName()) {
            return $this->getFirstName() . $this->getLastName();
        }

        return $this->getFirstName() . ' ' . $this->getLastName();
    }
}
