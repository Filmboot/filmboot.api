<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model\Abstracts;

/**
 * Class AbstractBaseModel.
 *
 * @package Myclapboard\CoreBundle\Model\Abstracts
 */
abstract class AbstractBaseModel
{
    /**
     * The id.
     *
     * @var string
     */
    protected $id;

    /**
     * Sets id.
     *
     * @param string $id The id
     *
     * @return $this self Object
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * String representation of a model class.
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->id;
    }
}
