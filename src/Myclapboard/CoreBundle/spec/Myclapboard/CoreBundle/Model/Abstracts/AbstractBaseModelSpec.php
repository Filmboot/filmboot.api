<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\CoreBundle\Model\Abstracts;

use PhpSpec\ObjectBehavior;

/**
 * Class AbstractBaseModelSpec.
 *
 * @package spec\Myclapboard\CoreBundle\Model\Abstracts
 */
class AbstractBaseModelSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf('Myclapboard\CoreBundle\Stubs\Model\Abstracts\AbstractBaseModelStub');
    }

    function it_does_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_id_is_mutable()
    {
        $this->setId('dummy-id')->shouldReturn($this);
        $this->getId()->shouldReturn('dummy-id');
    }

    function its_toString_returns_empty_string_if_its_id_is_null()
    {
        $this->__toString()->shouldReturn('');
    }

    function its_toString_returns_a_string()
    {
        $this->setId(123456)->shouldReturn($this);
        $this->__toString()->shouldReturn('123456');

        $this->setId('dummy-id')->shouldReturn($this);
        $this->__toString()->shouldReturn('dummy-id');
    }
}
