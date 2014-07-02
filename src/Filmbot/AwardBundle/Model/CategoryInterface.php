<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\AwardBundle\Model;

use Filmbot\AwardBundle\Entity\CategoryTranslation;

/**
 * Interface CategoryInterface.
 *
 * @package Filmbot\AwardBundle\Model
 */
interface CategoryInterface
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
     * @return \Filmbot\AwardBundle\Model\CategoryInterface
     */
    public function setName($name);

    /**
     * Gets array of translations.
     *
     * @return array<\Filmbot\AwardBundle\Entity\CategoryTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Filmbot\AwardBundle\Entity\CategoryTranslation $translation The translation
     *
     * @return \Filmbot\AwardBundle\Model\CategoryInterface
     */
    public function addTranslation(CategoryTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Filmbot\AwardBundle\Entity\CategoryTranslation $translation The translation
     *
     * @return \Filmbot\AwardBundle\Model\CategoryInterface
     */
    public function removeTranslation(CategoryTranslation $translation);
}
