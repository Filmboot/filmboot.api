<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\CoreBundle\Model;

use PhpSpec\ObjectBehavior;

/**
 * Class BaseImageSpec.
 *
 * @package spec\Myclapboard\CoreBundle\Model
 */
class BaseImageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\CoreBundle\Model\BaseImage');
    }

    function it_implements_base_image_interface()
    {
        $this->shouldImplement('Myclapboard\CoreBundle\Model\BaseImageInterface');
    }

    function its_name_is_mutable()
    {
        $this->setName('image-name')->shouldReturn($this);
        $this->getName()->shouldReturn('image-name');
    }
    
    function it_gets_absolute_path()
    {
        $this->getAbsolutePath()
//          ->shouldReturn(__DIR__ . '/../../../../../../../web/uploads/images')
        ;
    }
    
    public function it_gets_fixture_path()
    {
        $this->getFixturePath('movies')
//          ->shouldReturn(__DIR__ . '/../../../../../../../app/Resources/fixtures/images/movies/')
        ;
    }
} 
