<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\CoreBundle\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class BaseImage.
 *
 * @package Myclapboard\CoreBundle\Model
 */
class BaseImage implements BaseImageInterface
{
    protected $name;

    protected $file;

    /**
     * Constructor.
     */
    public function __construct()
    {
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
    public function getFixturePath($path)
    {
        return $this->getFixtureRootDir($path) . '/';
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
    protected function getFixtureRootDir($path)
    {
        return __DIR__ . '/../../../../app/' . $this->getFixtureDir($path);
    }

    /**
     * {@inheritdoc}
     */
    protected function getFixtureDir($path)
    {
        return 'Resources/fixtures/' . $path;
    }
}
