<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\CoreBundle\Listener;

use JMS\Serializer\EventDispatcher\ObjectEvent;
use Myclapboard\ArtistBundle\Model\Interfaces\ArtistInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Class ImageUrlSubscriberSpec.
 *
 * @package spec\Myclapboard\CoreBundle\Listener
 */
class ImageUrlSubscriberSpec extends ObjectBehavior
{
    function let(Router $router)
    {
        $this->beConstructedWith($router);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Listener\ImageUrlSubscriber');
    }

    function it_implements_event_subscriber_interface()
    {
        $this->shouldImplement('JMS\Serializer\EventDispatcher\EventSubscriberInterface');
    }

    function it_gets_subscribed_events()
    {
        $this->getSubscribedEvents()->shouldReturn(
            array(
                array(
                    'event'  => 'serializer.pre_serialize',
                    'method' => 'onChangeArtistPicture'
                ),
                array(
                    'event'  => 'serializer.pre_serialize',
                    'class'  => 'Myclapboard\MovieBundle\Entity\Movie',
                    'method' => 'onChangeMoviePicture'
                )
            )
        );
    }

    public function it_does_not_change_artist_picture_because_the_object_does_not_be_an_artist(
        ObjectEvent $event,
        MovieInterface $movie
    )
    {
        $event->getObject()->shouldBeCalled()->willReturn($movie);

        $this->onChangeArtistPicture($event);
    }

    public function it_does_not_change_artist_picture_because_the_name_already_become_into_url(
        ObjectEvent $event,
        ArtistInterface $artist
    )
    {
        $event->getObject()->shouldBeCalled()->willReturn($artist);
        $artist->getPicture()
            ->shouldBeCalled()->willReturn('http://myclapboard.com/uploads/images/quentin-tarantino.jpg');

        $this->onChangeArtistPicture($event);
    }

    public function it_changes_artist_picture(ObjectEvent $event, ArtistInterface $artist, Router $router)
    {
        $event->getObject()->shouldBeCalled()->willReturn($artist);
        $artist->getPicture()->shouldBeCalled()->willReturn('quentin-tarantino.jpg');

        $router->generate('myclapboard_core_get_image', array('name' => 'quentin-tarantino.jpg'), true)
            ->shouldBeCalled()->willReturn('http://myclapboard.com/uploads/images/quentin-tarantino.jpg');
        $artist->setPicture('http://myclapboard.com/uploads/images/quentin-tarantino.jpg')
            ->shouldBeCalled()->willReturn($artist);

        $this->onChangeArtistPicture($event);
    }

    public function it_changes_movie_picture(ObjectEvent $event, MovieInterface $movie, Router $router)
    {
        $event->getObject()->shouldBeCalled()->willReturn($movie);
        $movie->getPicture()->shouldBeCalled()->willReturn('django-unchained.jpg');

        $router->generate('myclapboard_core_get_image', array('name' => 'django-unchained.jpg'), true)
            ->shouldBeCalled()->willReturn('http://myclapboard.com/uploads/images/django-unchained.jpg');
        $movie->setPicture('http://myclapboard.com/uploads/images/django-unchained.jpg')
            ->shouldBeCalled()->willReturn($movie);

        $this->onChangeMoviePicture($event);
    }
}
