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

use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\AwardBundle\Model\Interfaces\AwardInterface;
use Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;

/**
 * Class AwardWon model: ternary relationship table that joins Movie, Role and Award tables.
 *
 * @package Myclapboard\AwardBundle\Model
 */
class AwardWon implements AwardWonInterface
{
    /**
     * The id.
     *
     * @var string
     */
    protected $id;

    /**
     * The movie.
     *
     * @var \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    protected $movie;

    /**
     * The actor.
     *
     * @var \Myclapboard\ArtistBundle\Entity\Actor
     */
    protected $actor;

    /**
     * The director.
     *
     * @var \Myclapboard\ArtistBundle\Entity\Director
     */
    protected $director;

    /**
     * The writer.
     *
     * @var \Myclapboard\ArtistBundle\Entity\Writer
     */
    protected $writer;

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
     * The year.
     *
     * @var int
     */
    protected $year;

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
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * {@inheritdoc}
     */
    public function setActor(Actor $actor)
    {
        $this->actor = $actor;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * {@inheritdoc}
     */
    public function setDirector(Director $director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * {@inheritdoc}
     */
    public function setWriter(Writer $writer)
    {
        $this->writer = $writer;

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
    public function setAward(AwardInterface $award)
    {
        $this->award = $award;

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
    public function setMovie(MovieInterface $movie)
    {
        $this->movie = $movie;

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
}
