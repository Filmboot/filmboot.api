<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\CoreBundle\Model;

use Myclapboard\ArtistBundle\Model\ArtistInterface;
use Myclapboard\MovieBundle\Model\MovieInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImageInterface
{   
    /**
     * Gets name.
     *
     * @return string
     */
    public function getName();

    /**
     * Sets name.
     *
     * @param string $name The name of image
     *
     * @return \Myclapboard\CoreBundle\Model\ImageInterface
     */
    public function setName($name);

    /**
     * Gets file.
     *
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getFile();

    /**
     * Sets file.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file The image file
     *
     * @return \Myclapboard\CoreBundle\Model\ImageInterface
     */
    public function setFile(UploadedFile $file = null);

    /**
     * Gets movie.
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Myclapboard\MovieBundle\Model\MovieInterface $movie The movie object
     *
     * @return \Myclapboard\CoreBundle\Model\ImageInterface
     */
    public function setMovie(MovieInterface $movie);

    /**
     * Gets artist.
     *
     * @return \Myclapboard\ArtistBundle\Model\ArtistInterface
     */
    public function getArtist();

    /**
     * Sets artist.
     *
     * @param \Myclapboard\ArtistBundle\Model\ArtistInterface $artist The artist object
     *
     * @return \Myclapboard\CoreBundle\Model\ImageInterface
     */
    public function setArtist(ArtistInterface $artist);

    /**
     * Uploads image creating a unique file name.
     *
     * @return void
     */
    public function upload();

    /**
     * LifecycleCallback function, it removes file associated to the name.
     *
     * @return void
     */
    public function removeUpload();

    /**
     * Gets the absolute path.
     *
     * @return string
     */
    public function getAbsolutePath();

    /**
     * Gets the fixture's absolute path.
     *
     * @param string $folder The name of the folder
     *
     * @return string
     */
    public function getFixturePath($folder);
} 
