<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\AwardBundle\Model;

use Filmbot\AwardBundle\Entity\AwardTranslation;

/**
 * Interface AwardInterface.
 *
 * @package Filmbot\AwardBundle\Model
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
     * @return \Filmbot\AwardBundle\Model\AwardInterface
     */
    public function setName($name);

    /**
     * Gets array of translations.
     *
     * @return array<\Filmbot\AwardBundle\Entity\AwardTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Filmbot\AwardBundle\Entity\AwardTranslation $translation The translation
     *
     * @return \Filmbot\AwardBundle\Model\AwardInterface
     */
    public function addTranslation(AwardTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Filmbot\AwardBundle\Entity\AwardTranslation $translation The translation
     *
     * @return \Filmbot\AwardBundle\Model\AwardInterface
     */
    public function removeTranslation(AwardTranslation $translation);
}
