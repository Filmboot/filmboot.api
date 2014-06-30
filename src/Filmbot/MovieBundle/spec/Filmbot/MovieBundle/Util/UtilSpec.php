<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmbot\MovieBundle\Util;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class UtilSpec.
 *
 * @package spec\Filmbot\MovieBundle\Util
 */
class UtilSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmbot\MovieBundle\Util\Util');
    }

    function it_gets_slug()
    {
        $this->getSlug('my illegible with ñ SLUG!!')->shouldReturn('my-illegible-with-n-slug');
    }
}
