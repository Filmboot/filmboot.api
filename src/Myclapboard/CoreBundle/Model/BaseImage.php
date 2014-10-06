<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model;

use Myclapboard\CoreBundle\Model\Interfaces\BaseImageInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class BaseImage.
 *
 * @package Myclapboard\CoreBundle\Model
 */
class BaseImage implements BaseImageInterface
{
    /**
     * The file.
     *
     * @var string
     */
    protected $file;

    /**
     * THe name.
     *
     * @var string
     */
    protected $name;

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
    public function getFile()
    {
        return $this->file;
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
    public function getName()
    {
        return $this->name;
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
        if (isset($this->file) === true) {
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
     * Returns the root directory of uploaded file.
     *
     * @return string
     */
    protected function getUploadRootDir()
    {
        $thisClass = new \ReflectionClass($this);

        return dirname($thisClass->getFileName()) . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * Returns the directory of uploaded file.
     *
     * @return string
     */
    protected function getUploadDir()
    {
        return 'uploads/images';
    }

    /**
     * Returns the root directory of fixture file.
     *
     * @param string $path The path
     *
     * @return string
     */
    protected function getFixtureRootDir($path)
    {
        $thisClass = new \ReflectionClass($this);

        return dirname($thisClass->getFileName()) . '/../../../../app/' . $this->getFixtureDir($path);
    }

    /**
     * Returns the directory of fixture file.
     *
     * @param string $path The path
     *
     * @return string
     */
    protected function getFixtureDir($path)
    {
        return 'Resources/fixtures/' . $path;
    }
}
