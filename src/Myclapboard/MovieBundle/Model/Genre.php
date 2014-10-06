<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\MovieBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Myclapboard\CoreBundle\Model\Abstracts\AbstractBaseModel;
use Myclapboard\CoreBundle\Model\Traits\TranslatableTrait;
use Myclapboard\MovieBundle\Model\Interfaces\GenreInterface;
use Myclapboard\MovieBundle\Util\Util;

/**
 * Class Genre model.
 *
 * @package Myclapboard\MovieBundle\Model
 */
class Genre extends AbstractBaseModel implements GenreInterface
{
    use TranslatableTrait;

    /**
     * The name.
     *
     * @var string
     */
    protected $name;

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
        $this->translations = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->slug = Util::getSlug($name);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
