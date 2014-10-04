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
use Myclapboard\UserBundle\Form\ReviewType;
use Myclapboard\UserBundle\Manager\ReviewManager;
use Myclapboard\UserBundle\Model\AccountInterface;
use Myclapboard\UserBundle\Model\ReviewInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Class ReviewControllerSpec.
 *
 * @package spec\Myclapboard\UserBundle\Controller
 */
class ReviewControllerSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Controller\ReviewController');
    }

    function it_extends_resource_controller()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Controller\ResourceController');
    }

    function it_does_not_get_the_reviews_because_the_user_is_not_logged(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        ParamFetcher $paramFetcher
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('getReviewsAction', array($paramFetcher));
    }

    function it_gets_reviews(
        ContainerInterface $container,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        ReviewManager $reviewManager,
        ViewHandler $viewHandler,
        ParamFetcher $paramFetcher
    )
    {
        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn($user);

        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $user->getId()->shouldBeCalled()->willReturn('user-logged-id');
        $paramFetcher->get('order')->shouldBeCalled()->willReturn('movie');
        $paramFetcher->get('count')->shouldBeCalled()->willReturn(10);
        $paramFetcher->get('page')->shouldBeCalled()->willReturn(0);
        $reviewManager->findAll('user-logged-id', 'movie', 10, 0)
            ->shouldBeCalled()->willReturn(array());

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getReviewsAction($paramFetcher);
    }

    function it_does_not_get_the_review_because_the_rating_does_not_exist(
        ContainerInterface $container,
        ReviewManager $reviewManager
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new NotFoundHttpException('Does not exist any review with review-id id'))
            ->during('getReviewAction', array('review-id'));
    }

    function it_does_not_get_the_review_because_the_reviews_user_and_logged_user_are_different(
        ContainerInterface $container,
        ReviewManager $reviewManager,
        ReviewInterface $review,
        AccountInterface $otherUser,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn($review);

        $this->checkSameId(
            $container,
            $review,
            $otherUser,
            $securityContext,
            $token,
            $user,
            'user-id', 'other-user-id'
        );

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('getReviewAction', array('review-id'));
    }

    function it_gets_review(
        ContainerInterface $container,
        ReviewManager $reviewManager,
        ReviewInterface $review,
        AccountInterface $otherUser,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn($review);

        $this->checkSameId(
            $container,
            $review,
            $otherUser,
            $securityContext,
            $token,
            $user,
            'user-id', 'user-id'
        );

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->getReviewAction('review-id');
    }

    function it_does_not_post_because_the_form_is_not_valid(
        ContainerInterface $container,
        ReviewManager $reviewManager,
        ReviewInterface $review,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        FormFactoryInterface $formFactory,
        FormInterface $form,
        Request $request,
        FormError $error,
        FormInterface $formChild,
        FormInterface $formGrandChild,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->create()
            ->shouldBeCalled()->willReturn($review);

        $this->baseManageForm(
            $container,
            $review,
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

        $this->postReviewsAction();
    }

    function it_posts_review(
        ContainerInterface $container,
        ReviewManager $reviewManager,
        ReviewInterface $review,
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
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->create()
            ->shouldBeCalled()->willReturn($review);

        $this->baseManageForm(
            $container,
            $review,
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
        $manager->persist($review)->shouldBeCalled();
        $manager->flush()->shouldBeCalled();

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->postReviewsAction();
    }

    function it_does_not_put_review_because_the_review_does_not_exist(
        ContainerInterface $container,
        ReviewManager $reviewManager
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new NotFoundHttpException('Does not exist any review with review-id id'))
            ->during('putReviewsAction', array('review-id'));
    }

    function it_does_not_put_the_review_because_the_reviews_user_and_logged_user_are_different(
        ContainerInterface $container,
        ReviewManager $reviewManager,
        ReviewInterface $review,
        AccountInterface $otherUser,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn($review);

        $this->checkSameId(
            $container,
            $review,
            $otherUser,
            $securityContext,
            $token,
            $user,
            'user-id', 'other-user-id'
        );

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('putReviewsAction', array('review-id'));
    }

    function it_does_not_put_because_the_form_is_not_valid(
        ContainerInterface $container,
        ReviewManager $reviewManager,
        ReviewInterface $review,
        AccountInterface $otherUser,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        FormFactoryInterface $formFactory,
        FormInterface $form,
        Request $request,
        FormError $error,
        FormInterface $formChild,
        FormInterface $formGrandChild,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn($review);

        $this->checkSameId(
            $container,
            $review,
            $otherUser,
            $securityContext,
            $token,
            $user,
            'user-id', 'user-id'
        );

        $this->baseManageForm(
            $container,
            $review,
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

        $this->putReviewsAction('review-id');
    }

    function it_puts_review(
        ContainerInterface $container,
        ReviewManager $reviewManager,
        ReviewInterface $review,
        AccountInterface $otherUser,
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
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn($review);

        $this->checkSameId(
            $container,
            $review,
            $otherUser,
            $securityContext,
            $token,
            $user,
            'user-id', 'user-id'
        );

        $this->baseManageForm(
            $container,
            $review,
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
        $manager->persist($review)->shouldBeCalled();
        $manager->flush()->shouldBeCalled();

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->putReviewsAction('review-id');
    }

    function it_does_not_delete_because_the_review_does_not_exist(
        ContainerInterface $container,
        ReviewManager $reviewManager
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn(null);

        $this->shouldThrow(new NotFoundHttpException('Does not exist any review with review-id id'))
            ->during('deleteReviewsAction', array('review-id'));
    }

    function it_does_not_delete_because_the_reviews_user_and_logged_user_are_different(
        ContainerInterface $container,
        ReviewManager $reviewManager,
        ReviewInterface $review,
        AccountInterface $otherUser,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn($review);

        $this->checkSameId(
            $container,
            $review,
            $otherUser,
            $securityContext,
            $token,
            $user,
            'user-id', 'other-user-id'
        );

        $this->shouldThrow(new AccessDeniedException('Not allowed to access this resource'))
            ->during('deleteReviewsAction', array('review-id'));
    }

    function it_deletes_review(
        ContainerInterface $container,
        ReviewManager $reviewManager,
        ReviewInterface $review,
        AccountInterface $otherUser,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        AbstractManagerRegistry $managerRegistry,
        ObjectManager $manager,
        ViewHandler $viewHandler
    )
    {
        $container->get('myclapboard_user.manager.review')
            ->shouldBeCalled()->willReturn($reviewManager);
        $reviewManager->findOneById('review-id')
            ->shouldBeCalled()->willReturn($review);

        $this->checkSameId(
            $container,
            $review,
            $otherUser,
            $securityContext,
            $token,
            $user,
            'user-id', 'user-id'
        );

        $container->has('doctrine')->shouldBeCalled()->willReturn(true);
        $container->get('doctrine')
            ->shouldBeCalled()->willReturn($managerRegistry);
        $managerRegistry->getManager()
            ->shouldBeCalled()->willReturn($manager);
        $manager->remove($review)->shouldBeCalled();
        $manager->flush()->shouldBeCalled();

        $container->get('fos_rest.view_handler')->shouldBeCalled()->willReturn($viewHandler);

        $this->deleteReviewsAction('review-id');
    }

    private function checkSameId(
        ContainerInterface $container,
        ReviewInterface $review,
        AccountInterface $otherUser,
        SecurityContext $securityContext,
        TokenInterface $token,
        AccountInterface $user,
        $arg1, $arg2
    )
    {
        $review->getUser()->shouldBeCalled()->willReturn($otherUser);
        $otherUser->getId()->shouldBeCalled()->willReturn($arg2);

        $this->getsUserLogged($container, $securityContext, $token)
            ->shouldBeCalled()->willReturn($user);
        $user->getId()->shouldBeCalled()->willReturn($arg1);
    }

    private function baseManageForm(
        ContainerInterface $container,
        ReviewInterface $review,
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

        $review->setUser($user)->shouldBeCalled()->willReturn($review);
        $container->get('form.factory')
            ->shouldBeCalled()->willReturn($formFactory);
        $formFactory->create(new ReviewType(), $review, array('csrf_protection' => false))
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
