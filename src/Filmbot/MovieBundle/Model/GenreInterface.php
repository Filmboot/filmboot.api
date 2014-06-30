<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\MovieBundle\Model;

/**
 * Interface GenreInterface.
 *
 * @package Filmbot\MovieBundle\Model
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
     * @return \Filmbot\MovieBundle\Model\GenreInterface
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
     * @return \Filmbot\MovieBundle\Model\GenreInterface
     */
    public function setName($name);
}
