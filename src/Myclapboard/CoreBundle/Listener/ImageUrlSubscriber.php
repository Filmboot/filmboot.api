<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
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
                'method' => 'onChangeArtistPhoto'
            ),
            array(
                'event'  => 'serializer.pre_serialize',
                'class'  => 'Myclapboard\MovieBundle\Entity\Movie',
                'method' => 'onChangeMoviePoster'
            )
        );
    }

    /**
     * Event that updates the photo attribute of artist object,
     * turning the name of the image into the absolute url.
     *
     * @param ObjectEvent $event The event
     *
     * @return void
     */
    public function onChangeArtistPhoto(ObjectEvent $event)
    {
        $artist = $event->getObject();

        if (method_exists($artist, 'getPhoto') === true
            && preg_match('/^[\w,\s-]+\.[A-Za-z]{3}$/', $artist->getPhoto()) === 1
        ) {
            $artist->setPhoto(
                $this->router->generate(
                    'myclapboard_core_get_image',
                    array('name' => $artist->getPhoto()),
                    true
                )
            );
        }
    }

    /**
     * Event that updates the poster attribute of movie object,
     * turning the name of the image into the absolute url.
     *
     * @param ObjectEvent $event The event
     *
     * @return void
     */
    public function onChangeMoviePoster(ObjectEvent $event)
    {
        $movie = $event->getObject();

        $movie->setPoster(
            $this->router->generate(
                'myclapboard_core_get_image',
                array('name' => $movie->getPoster()),
                true
            )
        );
    }
}
