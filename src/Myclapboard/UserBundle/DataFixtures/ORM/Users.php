<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\CoreBundle\DataFixtures\ORM\DataFixtures;

/**
 * Class Users.
 *
 * @package Myclapboard\UserBundle\DataFixtures\ORM
 */
class Users extends DataFixtures
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->createUsers($manager, 'user');
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
     * @param \Doctrine\Common\Persistence\ObjectManager $manager The object manager
     * @param string                                     $name    The name
     * @param string                                     $role    The role
     * @param bool                                       $enabled The enabled
     *
     * @return void
     */
    private function createUsers(ObjectManager $manager, $name = 'user', $role = 'ROLE_USER', $enabled = false)
    {
        $locations = $manager->getRepository('JJsGeonamesBundle:City')->findAll();
        $genders = array('female', 'male');

        for ($i = 0; $i < 10; $i++) {
            $user = $this->container->get('myclapboard_user.manager.user')->create();
            $user->setEmail($name . $i . '@gmail.com');
            $user->setFirstName($name . $i);
            $user->setLastName('surname');
            $user->setPlainPassword($name . $i);
            $user->setMobile('666666666');
            $user->setPhone('999999999');
            $user->setLocation($locations[array_rand($locations)]);
            $user->setBirthday(new \DateTime('198' . $i . '-0' . $i . '-1' . $i));
            $user->setGender($genders[array_rand($genders)]);
            $user->setRoles(array($role));
            $user->setEnabled($enabled);

            $manager->persist($user);
        }
    }
}
