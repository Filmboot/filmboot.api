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
use Myclapboard\MovieBundle\Model\MovieInterface;

/**
 * Class AwardWon model: ternary relationship table that joins Movie, Role and Award tables.
 *
 * @package Myclapboard\AwardBundle\Model
 */
class AwardWon implements AwardWonInterface
{
    protected $id;

    protected $movie;

    protected $actor;

    protected $director;

    protected $writer;

    protected $award;

    protected $category;

    protected $year;

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
