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

use Myclapboard\CoreBundle\Model\BaseImage;
use Myclapboard\MovieBundle\Model\Interfaces\ImageInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;

/**
 * Class Image.
 *
 * @package Myclapboard\MovieBundle\Model
 */
class Image extends BaseImage implements ImageInterface
{
    /**
     * The movie.
     *
     * @var \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    protected $movie;

    /**
     * {@inheritdoc}
     */
    public function setMovie(MovieInterface $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMovie()
    {
        return $this->movie;
    }
}
