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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * {@inheritdoc}
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * {@inheritdoc}
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->year . ': ' . $this->name . '. ' . $this->category;
    }
}
