<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Listener;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Class ImageUrlSubscriber.
 *
 * @package Myclapboard\CoreBundle\Listener
 */
class ImageUrlSubscriber implements EventSubscriberInterface
{
    private $router;

    /**
     * Constructor.
     *
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router The router instance
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event'  => 'serializer.pre_serialize',
                'method' => 'onChangeArtistPicture'
            ),
            array(
                'event'  => 'serializer.pre_serialize',
                'class'  => 'Myclapboard\MovieBundle\Entity\Movie',
                'method' => 'onChangeMoviePicture'
            )
        );
    }

    /**
     * Event that updates the picture attribute of artist object,
     * turning the name of the image into the absolute url.
     *
     * @param ObjectEvent $event The event
     *
     * @return void
     */
    public function onChangeArtistPicture(ObjectEvent $event)
    {
        $artist = $event->getObject();

        if (method_exists($artist, 'getPicture') === true
            && preg_match('/^[\w,\s-]+\.[A-Za-z]{3}$/', $artist->getPicture()) === 1
        ) {
            $artist->setPicture(
                $this->router->generate(
                    'myclapboard_core_get_image',
                    array('name' => $artist->getPicture()),
                    true
                )
            );
        }
    }

    /**
     * Event that updates the picture attribute of movie object,
     * turning the name of the image into the absolute url.
     *
     * @param ObjectEvent $event The event
     *
     * @return void
     */
    public function onChangeMoviePicture(ObjectEvent $event)
    {
        $movie = $event->getObject();

        $movie->setPicture(
            $this->router->generate(
                'myclapboard_core_get_image',
                array('name' => $movie->getPicture()),
                true
            )
        );
    }
}
