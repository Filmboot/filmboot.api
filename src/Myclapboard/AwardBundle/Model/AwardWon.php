<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Myclapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\Model;

use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;

/**
 * Class AwardWon model: ternary relationship table that joins Movie, Artist and Award tables.
 *
 * @package Myclapboard\AwardBundle\Model
 */
class AwardWon implements AwardWonInterface
{
    protected $id;
    
    protected $movie;
    
    protected $artist;
    
    protected $award;
    
    protected $category;
    
    protected $year;
    
    protected $role;

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
    public function setArtist(ArtistInterface $artist)
    {
        $this->artist = $artist;
        
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getArtist()
    {
        return $this->artist;
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
    public function getAward()
    {
        return $this->award;
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
    public function getRole()
    {
        return $this->role;
    }

    /**
     * {@inheritdoc}
     */
    public function setRole($role)
    {
        $this->role = $role;
        
        return $this;
    }
}
