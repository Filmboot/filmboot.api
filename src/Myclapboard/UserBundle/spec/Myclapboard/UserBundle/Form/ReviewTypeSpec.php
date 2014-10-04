<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\UserBundle\Form;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Form\FormBuilder;

/**
 * Class ReviewTypeSpec.
 *
 * @package spec\Myclapboard\UserBundle\Form
 */
class ReviewTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Form\ReviewType');
    }

    function it_extends_form_abstract_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    function it_builds_a_form(FormBuilder $builder)
    {
        $builder
            ->add('title')
            ->shouldBeCalled()->willReturn($builder);

        $builder
            ->add('content')
            ->shouldBeCalled()->willReturn($builder);
        
        $builder
            ->add('locale')
            ->shouldBeCalled()->willReturn($builder);
        
        $builder
            ->add(
                'movie', 'entity', array(
                    'class' => 'MyclapboardMovieBundle:Movie'
                )
            )
            ->shouldBeCalled()->willReturn($builder);
        
        $this->buildForm($builder, array());
    }
    
    function it_gets_name()
    {
        $this->getName()->shouldReturn('');    
    }
}
