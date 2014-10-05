<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Myclapboard\AwardBundle\Model;

use Myclapboard\AwardBundle\Entity\CategoryTranslation;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CategorySpec.
 *
 * @package spec\Myclapboard\AwardBundle\Model
 */
class CategorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\Model\Category');
    }

    function it_implements_category_interface()
    {
        $this->shouldImplement('Myclapboard\AwardBundle\Model\Interfaces\CategoryInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_name_is_mutable()
    {
        $this->setName('Best director')->shouldReturn($this);
        $this->getName()->shouldReturn('Best director');
    }

    function its_name_translations_be_mutable()
    {
        $translation = new CategoryTranslation('es', 'name', 'spanish-name-translation');

        $this->getTranslations()->shouldHaveCount(0);
        $this->addTranslation($translation);
        $this->getTranslations()->shouldHaveCount(1);

        // If array of translations contains translation, it does not add it again
        $this->addTranslation($translation);
        $this->getTranslations()->shouldHaveCount(1);

        $this->removeTranslation($translation);
        $this->getTranslations()->shouldHaveCount(0);
    }

    function its_to_string_is_formed_by_name()
    {
        $this->__toString()->shouldReturn(null);

        $this->setName('Best director')->shouldReturn($this);

        $this->__toString()->shouldReturn('Best director');
    }
}
