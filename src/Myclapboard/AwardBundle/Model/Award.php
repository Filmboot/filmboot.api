<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\AwardBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Myclapboard\AwardBundle\Model\Interfaces\AwardInterface;
use Myclapboard\CoreBundle\Model\Abstracts\AbstractBaseModel;
use Myclapboard\CoreBundle\Model\Traits\TranslatableTrait;

/**
 * Class Award model.
 *
 * @package Myclapboard\AwardBundle\Model
 */
class Award extends AbstractBaseModel implements AwardInterface
{
    use TranslatableTrait;

    /**
     * The name.
     *
     * @var string
     */
    protected $name;

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

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
}
