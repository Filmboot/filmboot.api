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

/**
 * Interface MediaInterface.
 *
 * @package Myclapboard\CoreBundle\Model\Interfaces
 */
interface MediaInterface
{
    /**
     * Sets picture.
     *
     * @param string $picture The picture
     *
     * @return $this self Object
     */
    public function setPicture($picture);

    /**
     * Gets picture.
     *
     * @return string
     */
    public function getPicture();

    /**
     * Sets website.
     *
     * @param string $website The website
     *
     * @return $this self Object
     */
    public function setWebsite($website);

    /**
     * Gets website.
     *
     * @return string
     */
    public function getWebsite();
}
