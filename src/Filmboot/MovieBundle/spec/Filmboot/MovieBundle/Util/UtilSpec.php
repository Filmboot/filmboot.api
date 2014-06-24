<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmboot\MovieBundle\Util;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UtilSpec.
 *
 * @package spec\Filmboot\MovieBundle\Util
 */
class UtilSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmboot\MovieBundle\Util\Util');
    }

    function it_gets_slug()
    {
        $this->getSlug('my illegible with ñ SLUG!!')->shouldReturn('my-illegible-with-n-slug');
    }
}