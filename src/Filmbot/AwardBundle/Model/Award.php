<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\AwardBundle\Model;

/**
 * Class Award model.
 *
 * @package Filmbot\AwardBundle\Model
 */
class Award implements AwardInterface
{
    protected $id;

    protected $name;

    protected $year;

    protected $category;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * {@inheritDoc}
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * {@inheritDoc}
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->year . ': ' . $this->name . '. ' . $this->category;
    }
}
