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

use Myclapboard\CoreBundle\Model\Interfaces\BaseImageInterface;

/**
 * Interface ImageInterface,
 *
 * @package Myclapboard\MovieBundle\Model\Interfaces
 */
interface ImageInterface extends BaseImageInterface
{
    /**
     * Gets movie.
     *
     * @return \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface $movie The movie object
     *
     * @return $this self Object
     */
    public function setMovie(MovieInterface $movie);
}
