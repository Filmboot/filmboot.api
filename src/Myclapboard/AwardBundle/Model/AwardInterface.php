<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Myclapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\Model;

use Myclapboard\AwardBundle\Entity\AwardTranslation;

/**
 * Interface AwardInterface.
 *
 * @package Myclapboard\AwardBundle\Model
 */
interface AwardInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

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
     * @return \Myclapboard\AwardBundle\Model\AwardInterface
     */
    public function setName($name);

    /**
     * Gets array of translations.
     *
     * @return array<\Myclapboard\AwardBundle\Entity\AwardTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Myclapboard\AwardBundle\Entity\AwardTranslation $translation The translation
     *
     * @return \Myclapboard\AwardBundle\Model\AwardInterface
     */
    public function addTranslation(AwardTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Myclapboard\AwardBundle\Entity\AwardTranslation $translation The translation
     *
     * @return \Myclapboard\AwardBundle\Model\AwardInterface
     */
    public function removeTranslation(AwardTranslation $translation);
}
