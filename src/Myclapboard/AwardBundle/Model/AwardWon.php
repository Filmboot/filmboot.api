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

use Myclapboard\AwardBundle\Model\Interfaces\AwardInterface;
use Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface;
use Myclapboard\CoreBundle\Model\Abstracts\AbstractBaseModel;
use Myclapboard\CoreBundle\Model\Traits\RoleTrait;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;

/**
 * Class AwardWon model: ternary relationship table that joins Movie, Role and Award tables.
 *
 * @package Myclapboard\AwardBundle\Model
 */
class AwardWon extends AbstractBaseModel implements AwardWonInterface
{
    use RoleTrait;

    /**
     * The award.
     *
     * @var \Myclapboard\AwardBundle\Model\Interfaces\AwardInterface
     */
    protected $award;

    /**
     * The category.
     *
     * @var \Myclapboard\AwardBundle\Model\Interfaces\CategoryInterface
     */
    protected $category;

    /**
     * The movie.
     *
     * @var \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    protected $movie;

    /**
     * The year.
     *
     * @var int
     */
    protected $year;

    /**
     * {@inheritdoc}
     */
    public function setAward(AwardInterface $award)
    {
        $this->award = $award;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAward()
    {
        return $this->award;
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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * {@inheritdoc}
     */
    public function setMovie(MovieInterface $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMovie()
    {
        return $this->movie;
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
    public function getYear()
    {
        return $this->year;
    }
}
