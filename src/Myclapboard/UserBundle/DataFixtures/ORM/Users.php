<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 * 
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Users.
 *
 * @package Myclapboard\UserBundle\DataFixtures\ORM
 */
class Users extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->createUsers($manager);
        $this->createUsers($manager, 'admin', 'ROLE_ADMIN', true);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 0;
    }

    /**
     * Creates ten users with with name, role and activated given. 
     * 
     * @param \Doctrine\Common\Persistence\ObjectManager $manager   The object manager
     * @param string                                     $name      The name
     * @param string                                     $role      The role
     * @param bool                                       $activated The activated
     *
     * @return void
     */
    private function createUsers(ObjectManager $manager, $name = 'user', $role = 'ROLE_USER', $activated = false)
    {
        $locations = $manager->getRepository('JJsGeonamesBundle:City')->findAll();
        $genders = array('female', 'male');

        for ($i = 0; $i < 10; $i++) {
            $user = $this->container->get('myclapboard_user.manager.user')->create();
            $user->setEmail($name . $i . '@gmail.com');
            $user->setFirstName($name . $i);
            $user->setLastName('surname');
            
            $plainPass = $name . $i;
            $user->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
            $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
            $encodedPass = $encoder->encodePassword($plainPass, $user->getSalt());
            $user->setPassword($encodedPass);

            $user->setMobile('666666666');
            $user->setPhone('999999999');
            $user->setLocation($locations[array_rand($locations)]);
            $user->setBirthday(new \DateTime('198' . $i . '-0' . $i . '-1' . $i));
            $user->setGender($genders[array_rand($genders)]);
            $user->setRole($role);
            $user->setActivated($activated);

            $manager->persist($user);
        }
    }
}
