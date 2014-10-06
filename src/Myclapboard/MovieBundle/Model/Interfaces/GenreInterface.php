<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\MovieBundle\Model\Interfaces;

use Myclapboard\CoreBundle\Model\Interfaces\TranslatableInterface;

/**
 * Interface GenreInterface.
 *
 * @package Myclapboard\MovieBundle\Model\Interfaces
 */
interface GenreInterface extends TranslatableInterface
{
    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Sets slug.
     *
     * @param string $slug The slug
     *
     * @return $this self Object
     */
    public function setSlug($slug);

    /**
     * Gets slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Sets name.
     *
     * @param string $name The name
     *
     * @return $this self Object
     */
    public function setName($name);

    /**
     * Gets name.
     *
     * @return string
     */
    public function getName();
}
