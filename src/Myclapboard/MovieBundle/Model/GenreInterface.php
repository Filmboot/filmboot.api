<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\MovieBundle\Model;

use Myclapboard\MovieBundle\Entity\GenreTranslation;

/**
 * Interface GenreInterface.
 *
 * @package Myclapboard\MovieBundle\Model
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
     * @return \Myclapboard\MovieBundle\Model\GenreInterface
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
     * @return \Myclapboard\MovieBundle\Model\GenreInterface
     */
    public function setName($name);

    /**
     * Gets array of translations.
     *
     * @return array<\Myclapboard\MovieBundle\Entity\GenreTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Myclapboard\MovieBundle\Entity\GenreTranslation $translation The translation
     *
     * @return \Myclapboard\MovieBundle\Model\GenreInterface
     */
    public function addTranslation(GenreTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Myclapboard\MovieBundle\Entity\GenreTranslation $translation The translation
     *
     * @return \Myclapboard\MovieBundle\Model\GenreInterface
     */
    public function removeTranslation(GenreTranslation $translation);
}
