<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\UserBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RegistrationTypeSpec.
 *
 * @package spec\Myclapboard\UserBundle\Form\Type
 */
class RegistrationTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Form\Type\RegistrationType');
    }

    function it_extends_form_abstract_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    function it_builds_a_form(FormBuilderInterface $builder)
    {
        $builder
            ->remove('username')
            ->shouldBeCalled()->willReturn($builder);

        $this->buildForm($builder, array());
    }

    function it_sets_default_options(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('csrf_protection' => false))
            ->shouldBeCalled()->willReturn($resolver);

        $this->setDefaultOptions($resolver);
    }

    function it_gets_parent()
    {
        $this->getParent()->shouldReturn('fos_user_registration');
    }

    function it_gets_name()
    {
        $this->getName()->shouldReturn('myclapboard_user_registration');
    }
}
