<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Filmboot\AwardBundle\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AwardSpec.
 *
 * @package spec\Filmboot\AwardBundle\Model
 */
class AwardSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Filmboot\AwardBundle\Model\Award');
    }

    function it_implements_award_interface()
    {
        $this->shouldImplement('Filmboot\AwardBundle\Model\AwardInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_name_is_mutable()
    {
        $this->setName('Oscar')->shouldReturn($this);
        $this->getName()->shouldReturn('Oscar');
    }

    function its_year_is_mutable()
    {
        $this->setYear('2010')->shouldReturn($this);
        $this->getYear()->shouldReturn('2010');
    }

    function its_category_is_mutable()
    {
        $this->setCategory('Best movie')->shouldReturn($this);
        $this->getCategory()->shouldReturn('Best movie');
    }
    
    function its_to_string_is_formed_by_year_plus_name_plus_category()
    {
        $this->__toString()->shouldReturn(': . ');

        $this->setName('Oscar')->shouldReturn($this);
        $this->setYear('2010')->shouldReturn($this);
        $this->setCategory('Best movie')->shouldReturn($this);
        
        $this->__toString()->shouldReturn('2010: Oscar. Best movie');
    }
}
