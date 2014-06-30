<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\AwardBundle\Model;

use Filmboot\ArtistBundle\Model\ArtistInterface;
use Filmboot\MovieBundle\Model\MovieInterface;

/**
 * Class AwardWon model: ternary relationship table that joins Movie, Artist and Award tables.
 *
 * @package Filmboot\AwardBundle\Model
 */
class AwardWon implements AwardWonInterface
{
    protected $id;
    
    protected $movie;
    
    protected $artist;
    
    protected $award;
    
    protected $role;

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
    public function setArtist(ArtistInterface $artist)
    {
        $this->artist = $artist;
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * {@inheritDoc}
     */
    public function setAward(AwardInterface $award)
    {
        $this->award = $award;
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAward()
    {
        return $this->award;
    }

    /**
     * {@inheritDoc}
     */
    public function setMovie(MovieInterface $movie)
    {
        $this->movie = $movie;
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMovie()
    {
        return $this->movie;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * {@inheritDoc}
     */
    public function setRole($role)
    {
        $this->role = $role;
        
        return $this;
    }
} 