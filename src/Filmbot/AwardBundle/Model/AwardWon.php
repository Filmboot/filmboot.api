<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\AwardBundle\Model;

use Filmbot\ArtistBundle\Model\ArtistInterface;
use Filmbot\MovieBundle\Model\MovieInterface;

/**
 * Class AwardWon model: ternary relationship table that joins Movie, Artist and Award tables.
 *
 * @package Filmbot\AwardBundle\Model
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
