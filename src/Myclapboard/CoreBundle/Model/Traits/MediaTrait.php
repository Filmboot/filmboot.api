<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model\Traits;

/**
 * Trait MediaTrait.
 *
 * @package Myclapboard\CoreBundle\Model\Traits
 */
trait MediaTrait
{
    /**
     * The picture.
     *
     * @var string
     */
    protected $picture;

    /**
     * The url of website.
     *
     * @var string
     */
    protected $website;

    /**
     * Sets picture.
     *
     * @param string $picture The picture
     *
     * @return $this self Object
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Gets picture.
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Sets website.
     *
     * @param string $website The website
     *
     * @return $this self Object
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Gets website.
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }
}
