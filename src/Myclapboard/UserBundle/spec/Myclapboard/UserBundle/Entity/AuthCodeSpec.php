<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AuthCodeSpec.
 *
 * @package spec\Myclapboard\UserBundle\Entity
 */
class AuthCodeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Entity\AuthCode');
    }

    function it_extends_fos_oauth_server_auth_code()
    {
        $this->shouldHaveType('FOS\OAuthServerBundle\Entity\AuthCode');
    }
}
