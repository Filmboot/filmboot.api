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
 * Class AccessTokenSpec.
 *
 * @package spec\Myclapboard\UserBundle\Entity
 */
class AccessTokenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Entity\AccessToken');
    }

    function it_extends_fos_oauth_server_access_token()
    {
        $this->shouldHaveType('FOS\OAuthServerBundle\Entity\AccessToken');
    }
}
