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

/**
 * Class Image.
 *
 * @package Myclapboard\CoreBundle\Model
 */
class Image implements ImageInterface
{
    protected $id;

    protected $name;

    protected $file;

    protected $movie;

    protected $artist;

    /**
     * Constructor.
     */
    public function __construct()
    {
    }
    
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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
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
    public function getArtist()
    {
        return $this->artist;
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
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $fileName = uniqid() . '.' . $this->getFile()->guessExtension();

        $this->file->move($this->getUploadRootDir(), $fileName);

        $this->setName($fileName);
        $this->setFile(null);
    }

    /**
     * {@inheritdoc}
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($this->file);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAbsolutePath()
    {
        return $this->getUploadRootDir() . '/' . $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getFixturePath($folder)
    {
        return $this->getFixtureRootDir($folder) . '/';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * {@inheritdoc}
     */
    protected function getUploadDir()
    {
        return 'uploads/images';
    }

    /**
     * {@inheritdoc}
     */
    protected function getFixtureRootDir($folder)
    {
        return __DIR__ . '/../../../../app/' . $this->getFixtureDir($folder);
    }

    /**
     * {@inheritdoc}
     */
    protected function getFixtureDir($folder)
    {
        return 'Resources/fixtures/images/' . $folder;
    }
} 
