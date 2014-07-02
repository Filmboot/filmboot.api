<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\MovieBundle\Model;

use Filmbot\MovieBundle\Entity\GenreTranslation;

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

    /**
     * Gets array of translations.
     *
     * @return array<\Filmbot\MovieBundle\Entity\GenreTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Filmbot\MovieBundle\Entity\GenreTranslation $translation The translation
     *
     * @return \Filmbot\MovieBundle\Model\GenreInterface
     */
    public function addTranslation(GenreTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Filmbot\MovieBundle\Entity\GenreTranslation $translation The translation
     *
     * @return \Filmbot\MovieBundle\Model\GenreInterface
     */
    public function removeTranslation(GenreTranslation $translation);
}
