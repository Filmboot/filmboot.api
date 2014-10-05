<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\UserBundle\Controller;

use Doctrine\Common\Persistence\AbstractManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\ViewHandler;
use Myclapboard\MovieBundle\Manager\MovieManager;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use Myclapboard\UserBundle\Form\Type\RatingType;
use Myclapboard\UserBundle\Manager\RatingManager;
use Myclapboard\UserBundle\Model\Interfaces\AccountInterface;
use Myclapboard\UserBundle\Model\Interfaces\RatingInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Class RatingControllerSpec.
 *
 * @package spec\Myclapboard\UserBundle\Controller
 */
class RatingControllerSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Controller\RatingController');
    }

    function it_extends_resource_controller()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Controller\ResourceController');
    }

    function it_does_not_get_the_ratings_because_the_user_is_not_logged(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        ParamFetcher $paramFetcher
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('getRatingsAction', array($paramFetcher));
    }

    function it_gets_ratings(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        RatingManager $ratingManager,
        ViewHandler $viewHandler,
        ParamFetcher $paramFetcher
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn($user);

        $container->get('myclapboard_user.manager.rating')
            ->shouldBeCalled()->willReturn($ratingManager);
        $user->getId()->shouldBeCalled()->willReturn('user-logged-id');
        $paramFetcher->get('order')->shouldBeCalled()->willReturn('movie');
        $paramFetcher->get('count')->shouldBeCalled()->willReturn(10);
        $paramFetcher->get('page')->shouldBeCalled()->willReturn(0);
        $ratingManager->findAll('user-logged-id', 'movie', 10, 0)
            ->shouldBeCalled()->willReturn(array());

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getRatingsAction($paramFetcher);
    }

    function it_does_not_get_the_rating_because_the_user_is_not_logged(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('getRatingAction', array('movie-id'));
    }

    function it_does_not_get_the_rating_because_the_movie_not_found(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager
    )
    {
        $this->movieDoesNotExist(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            'getRatingAction'
        );
    }

    function it_does_not_get_the_rating_because_the_rating_not_found(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager
    )
    {
        $this->ratingsDoesNotExist(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            $movie,
            $ratingManager,
            'getRatingAction'
        );
    }

    function it_gets_rating(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager,
        RatingInterface $rating,
        ViewHandler $viewHandler
    )
    {
        $this->getsExistingRating(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            $movie,
            $ratingManager,
            $rating
        );

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getRatingAction('movie-id');
    }

    function it_does_not_post_rating_because_the_user_is_not_logged(
        ContainerInterface $container,
        RatingManager $ratingManager,
        RatingInterface $rating,
        SecurityContext $securityContext,
        TokenInterface $token
    )
    {
        $container->get('myclapboard_user.manager.rating')
            ->shouldBeCalled()->willReturn($ratingManager);
        $ratingManager->create()
            ->shouldBeCalled()->willReturn($rating);

        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('postRatingsAction');
    }

    function it_does_not_post_rating_because_the_form_is_not_valid(
        ContainerInterface $container,
        RatingManager $ratingManager,
        RatingInterface $rating,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        FormFactoryInterface $formFactory,
        FormInterface $form,
        Request $request,
        ViewHandler $viewHandler,
        FormError $error,
        FormInterface $formChild,
        FormInterface $formGrandChild
    )
    {
        $container->get('myclapboard_user.manager.rating')
            ->shouldBeCalled()->willReturn($ratingManager);
        $ratingManager->create()
            ->shouldBeCalled()->willReturn($rating);

        $form = $this->baseManageForm(
            $container,
            $rating,
            $securityContext,
            $token,
            $user,
            $formFactory,
            $form,
            $request
        );
        $form->isValid()->shouldBeCalled()->willReturn(false);
        $form->getErrors()->shouldBeCalled()->willReturn(array($error));
        $error->getMessage()->shouldBeCalled()->willReturn('error message');
        $form->all()->shouldBeCalled()->willReturn(array($formChild));
        $formChild->isValid()->shouldBeCalled()->willReturn(false);
        $formChild->getName()->shouldBeCalled()->willReturn('form child name');

        $formChild->getErrors()->shouldBeCalled()->willReturn(array($error));
        $error->getMessage()->shouldBeCalled()->willReturn('error message');
        $formChild->all()->shouldBeCalled()->willReturn(array($formGrandChild));
        $formGrandChild->isValid()->shouldBeCalled()->willReturn(true);

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->postRatingsAction();
    }

    function it_posts_rating(
        ContainerInterface $container,
        RatingManager $ratingManager,
        RatingInterface $rating,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        FormFactoryInterface $formFactory,
        FormInterface $form,
        Request $request,
        AbstractManagerRegistry $managerRegistry,
        ObjectManager $manager,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_user.manager.rating')
            ->shouldBeCalled()->willReturn($ratingManager);
        $ratingManager->create()
            ->shouldBeCalled()->willReturn($rating);

        $form = $this->baseManageForm(
            $container,
            $rating,
            $securityContext,
            $token,
            $user,
            $formFactory,
            $form,
            $request
        );
        $form->isValid()->shouldBeCalled()->willReturn(true);
        $container->has('doctrine')->shouldBeCalled()->willReturn(true);
        $container->get('doctrine')
            ->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()
            ->shouldBeCalled()->willReturn($manager);
        $manager->persist($rating)->shouldBeCalled();
        $manager->flush()->shouldBeCalled();

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->postRatingsAction();
    }

    function it_does_not_put_rating_because_the_user_is_not_logged(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('putRatingsAction', array('movie-id'));
    }

    function it_does_not_put_rating_because_the_movie_does_not_exist(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager
    )
    {
        $this->movieDoesNotExist(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            'putRatingsAction'
        );
    }

    function it_does_not_put_rating_because_rating_does_not_exist(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager
    )
    {
        $this->ratingsDoesNotExist(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            $movie,
            $ratingManager,
            'putRatingsAction'
        );
    }

    function it_does_no_put_rating_because_movie_attribute_is_not_possible_to_update(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager,
        RatingInterface $rating,
        Request $request
    )
    {
        $rating = $this->getsExistingRating(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            $movie,
            $ratingManager,
            $rating
        );

        $container->get('request')->shouldBeCalled()->willReturn($request);
        $request->get('movie')->shouldBeCalled()->willReturn('other-movie-id');
        $rating->getMovie()->shouldBeCalled()->willReturn($movie);
        $movie->getId()->shouldBeCalled()->willReturn('movie-id');

        $this->shouldThrow(
            new BadRequestHttpException('Movie attribute is not possible to update')
        )->during('putRatingsAction', array('movie-id'));
    }

    function it_does_not_put_rating_because_the_form_is_not_valid(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager,
        RatingInterface $rating,
        Request $request,
        FormFactoryInterface $formFactory,
        FormInterface $form,
        FormError $error,
        FormInterface $formChild,
        FormInterface $formGrandChild,
        ViewHandler $viewHandler
    )
    {
        $rating = $this->getsExistingRating(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            $movie,
            $ratingManager,
            $rating
        );

        $container->get('request')->shouldBeCalled()->willReturn($request);
        $request->get('movie')->shouldBeCalled()->willReturn('movie-id');
        $rating->getMovie()->shouldBeCalled()->willReturn($movie);
        $movie->getId()->shouldBeCalled()->willReturn('movie-id');

        $form = $this->baseManageForm(
            $container,
            $rating,
            $securityContext,
            $token,
            $user,
            $formFactory,
            $form,
            $request
        );
        $form->isValid()->shouldBeCalled()->willReturn(false);
        $form->getErrors()->shouldBeCalled()->willReturn(array($error));
        $error->getMessage()->shouldBeCalled()->willReturn('error message');
        $form->all()->shouldBeCalled()->willReturn(array($formChild));
        $formChild->isValid()->shouldBeCalled()->willReturn(false);
        $formChild->getName()->shouldBeCalled()->willReturn('form child name');

        $formChild->getErrors()->shouldBeCalled()->willReturn(array($error));
        $error->getMessage()->shouldBeCalled()->willReturn('error message');
        $formChild->all()->shouldBeCalled()->willReturn(array($formGrandChild));
        $formGrandChild->isValid()->shouldBeCalled()->willReturn(true);

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->putRatingsAction('movie-id');
    }

    function it_puts_rating(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager,
        RatingInterface $rating,
        Request $request,
        FormFactoryInterface $formFactory,
        FormInterface $form,
        ViewHandler $viewHandler,
        AbstractManagerRegistry $managerRegistry,
        ObjectManager $manager
    )
    {
        $rating = $this->getsExistingRating(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            $movie,
            $ratingManager,
            $rating
        );

        $container->get('request')->shouldBeCalled()->willReturn($request);
        $request->get('movie')->shouldBeCalled()->willReturn('movie-id');
        $rating->getMovie()->shouldBeCalled()->willReturn($movie);
        $movie->getId()->shouldBeCalled()->willReturn('movie-id');

        $form = $this->baseManageForm(
            $container,
            $rating,
            $securityContext,
            $token,
            $user,
            $formFactory,
            $form,
            $request
        );
        $form->isValid()->shouldBeCalled()->willReturn(true);
        $container->has('doctrine')->shouldBeCalled()->willReturn(true);
        $container->get('doctrine')
            ->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()
            ->shouldBeCalled()->willReturn($manager);
        $manager->persist($rating)->shouldBeCalled();
        $manager->flush()->shouldBeCalled();

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->putRatingsAction('movie-id');
    }

    function it_does_not_delete_because_the_user_is_not_logged(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('deleteRatingsAction', array('movie-id'));
    }

    function it_does_not_delete_because_the_movie_does_not_exist(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager
    )
    {
        $this->movieDoesNotExist(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            'deleteRatingsAction'
        );
    }

    function it_does_not_delete_because_rating_does_not_exist(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager
    )
    {
        $this->ratingsDoesNotExist(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            $movie,
            $ratingManager,
            'deleteRatingsAction'
        );
    }

    function it_deletes_rating(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager,
        RatingInterface $rating,
        AbstractManagerRegistry $managerRegistry,
        ObjectManager $manager,
        ViewHandler $viewHandler
    )
    {
        $rating = $this->getsExistingRating(
            $container,
            $securityContext,
            $token,
            $user,
            $movieManager,
            $movie,
            $ratingManager,
            $rating
        );
        $container->has('doctrine')->shouldBeCalled()->willReturn(true);
        $container->get('doctrine')
            ->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()
            ->shouldBeCalled()->willReturn($manager);
        $manager->remove($rating)->shouldBeCalled();
        $manager->flush()->shouldBeCalled();

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->deleteRatingsAction('movie-id');
    }

    private function getsExistingRating(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager,
        RatingInterface $rating
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn($user);

        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn($movie);

        $container->get('myclapboard_user.manager.rating')
            ->shouldBeCalled()->willReturn($ratingManager);
        $user->getId()->shouldBeCalled()->willReturn('user-id');
        $ratingManager->findOneByUserAndMovie('user-id', 'movie-id')
            ->shouldBeCalled()->willReturn($rating);

        return $rating;
    }

    private function ratingsDoesNotExist(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        MovieInterface $movie,
        RatingManager $ratingManager,
        $method
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn($user);

        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn($movie);

        $container->get('myclapboard_user.manager.rating')
            ->shouldBeCalled()->willReturn($ratingManager);
        $user->getId()->shouldBeCalled()->willReturn('user-id');
        $ratingManager->findOneByUserAndMovie('user-id', 'movie-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(
            new NotFoundHttpException('Does not exist any rating with movie-id id of movie for user-id user')
        )->during($method, array('movie-id'));
    }

    private function movieDoesNotExist(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        MovieManager $movieManager,
        $method
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn($user);

        $container->get('myclapboard_movie.manager.movie')
            ->shouldBeCalled()->willReturn($movieManager);
        $movieManager->findOneById('movie-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new NotFoundHttpException('Movie not found'))
            ->during($method, array('movie-id'));
    }

    private function baseManageForm(
        ContainerInterface $container,
        RatingInterface $rating,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        FormFactoryInterface $formFactory,
        FormInterface $form,
        Request $request
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn($user);

        $rating->setUser($user)->shouldBeCalled()->willReturn($rating);
        $container->get('form.factory')
            ->shouldBeCalled()->willReturn($formFactory);
        $formFactory->create(new RatingType(), $rating, array('csrf_protection' => false))
            ->shouldBeCalled()->willReturn($form);
        $container->get('request')
            ->shouldBeCalled()->willReturn($request);
        $form->submit($request)->shouldBeCalled()->willReturn($form);

        return $form;
    }

    private function getsUserLogged(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token
    )
    {
        $container->has('security.context')->shouldBeCalled()->willReturn(true);
        $container->get('security.context')->shouldBeCalled()->willReturn($securityContext);
        $securityContext->getToken()->shouldBeCalled()->willReturn($token);

        return $token->getUser();
    }
}
