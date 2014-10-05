<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model\Interfaces;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface BaseImageInterface,
 *
 * @package Myclapboard\CoreBundle\Model
 */
interface BaseImageInterface
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
     * @return $this self Object
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
     * @return $this self Object
     */
    public function setFile(UploadedFile $file = null);

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
