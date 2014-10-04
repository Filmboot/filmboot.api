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

/**
 * Interface ImageInterface,
 *
 * @package Myclapboard\MovieBundle\Model
 */
interface ImageInterface
{
    /**
     * Gets movie.
     *
     * @return \Myclapboard\MovieBundle\Model\MovieInterface
     */
    public function getMovie();

    /**
     * Sets movie.
     *
     * @param \Myclapboard\MovieBundle\Model\MovieInterface $movie The movie object
     *
     * @return \Myclapboard\MovieBundle\Model\ImageInterface
     */
    public function setMovie(MovieInterface $movie);
}
