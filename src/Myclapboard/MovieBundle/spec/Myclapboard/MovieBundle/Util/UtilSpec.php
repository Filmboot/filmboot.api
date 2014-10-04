<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\MovieBundle\Util;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UtilSpec.
 *
 * @package spec\Myclapboard\MovieBundle\Util
 */
class UtilSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\MovieBundle\Util\Util');
    }

    function it_gets_slug()
    {
        $this->getSlug('my illegible with ñ SLUG!!')->shouldReturn('my-illegible-with-n-slug');
    }
}
