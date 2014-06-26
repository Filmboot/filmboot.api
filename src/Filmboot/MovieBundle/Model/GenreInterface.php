<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\MovieBundle\Model;

/**
 * Interface GenreInterface.
 *
 * @package Filmboot\MovieBundle\Model
 */
interface GenreInterface
{
    /**
     * Gets id.
     * 
     * @return string
     */
    public function getId();

    /**
     * Gets slug.
     * 
     * @return string
     */
    public function getSlug();

    /**
     * Sets slug.
     * 
     * @param string $slug The slug
     * 
     * @return \Filmboot\MovieBundle\Model\GenreInterface
     */
    public function setSlug($slug);

    /**
     * Gets name.
     *
     * @return string
     */
    public function getName();

    /**
     * Sets name.
     *
     * @param string $name The name
     *
     * @return \Filmboot\MovieBundle\Model\GenreInterface
     */
    public function setName($name);
}
