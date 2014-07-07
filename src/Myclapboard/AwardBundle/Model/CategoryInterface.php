<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\Model;

use Myclapboard\AwardBundle\Entity\CategoryTranslation;

/**
 * Interface CategoryInterface.
 *
 * @package Myclapboard\AwardBundle\Model
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
     * @return \Myclapboard\AwardBundle\Model\CategoryInterface
     */
    public function setName($name);

    /**
     * Gets array of translations.
     *
     * @return array<\Myclapboard\AwardBundle\Entity\CategoryTranslation>
     */
    public function getTranslations();

    /**
     * Adds translation.
     *
     * @param \Myclapboard\AwardBundle\Entity\CategoryTranslation $translation The translation
     *
     * @return \Myclapboard\AwardBundle\Model\CategoryInterface
     */
    public function addTranslation(CategoryTranslation $translation);

    /**
     * Removes translation.
     *
     * @param \Myclapboard\AwardBundle\Entity\CategoryTranslation $translation The translation
     *
     * @return \Myclapboard\AwardBundle\Model\CategoryInterface
     */
    public function removeTranslation(CategoryTranslation $translation);
}
