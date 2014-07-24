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
 * Class ClientSpec.
 *
 * @package spec\Myclapboard\UserBundle\Entity
 */
class ClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Entity\Client');
    }

    function it_extends_fos_oauth_server_client()
    {
        $this->shouldHaveType('FOS\OAuthServerBundle\Entity\Client');
    }
}
