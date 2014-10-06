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
use Myclapboard\CoreBundle\Model\Abstracts\AbstractBaseModel;
use Myclapboard\CoreBundle\Model\Traits\CollectionTrait;
use Myclapboard\CoreBundle\Model\Traits\HumanTrait;
use Myclapboard\CoreBundle\Model\Traits\MediaTrait;
use Myclapboard\CoreBundle\Model\Traits\TranslatableTrait;
use Myclapboard\MovieBundle\Util\Util;

/**
 * Class Artist model.
 *
 * @package Myclapboard\ArtistBundle\Model
 */
class Artist extends AbstractBaseModel implements ArtistInterface
{
    use CollectionTrait;
    use HumanTrait;
    use MediaTrait;
    use TranslatableTrait;

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
        $this->actors = new ArrayCollection();
        $this->directors = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->writers = new ArrayCollection();

        $this->translations = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug()
    {
        $this->slug = Util::getSlug($this->firstName . '-' . $this->lastName);

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
}
