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

use Myclapboard\ArtistBundle\Entity\Actor;
use Myclapboard\ArtistBundle\Entity\Director;
use Myclapboard\ArtistBundle\Entity\Writer;
use Myclapboard\AwardBundle\Model\Interfaces\AwardInterface;
use Myclapboard\AwardBundle\Model\Interfaces\CategoryInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AwardWonSpec.
 *
 * @package spec\Myclapboard\AwardBundle\Model
 */
class AwardWonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\AwardBundle\Model\AwardWon');
    }

    function it_implements_award_won_interface()
    {
        $this->shouldImplement('Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface');
    }

    function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function its_movie_is_mutable(MovieInterface $movie)
    {
        $this->setMovie($movie)->shouldReturn($this);
        $this->getMovie()->shouldReturn($movie);
    }

    function its_actor_is_mutable(Actor $actor)
    {
        $this->setActor($actor)->shouldReturn($this);
        $this->getActor()->shouldReturn($actor);
    }

    function its_director_is_mutable(Director $director)
    {
        $this->setDirector($director)->shouldReturn($this);
        $this->getDirector()->shouldReturn($director);
    }

    function its_writer_is_mutable(Writer $writer)
    {
        $this->setWriter($writer)->shouldReturn($this);
        $this->getWriter()->shouldReturn($writer);
    }

    function its_award_is_mutable(AwardInterface $award)
    {
        $this->setAward($award)->shouldReturn($this);
        $this->getAward()->shouldReturn($award);
    }

    function its_category_is_mutable(CategoryInterface $category)
    {
        $this->setCategory($category)->shouldReturn($this);
        $this->getCategory()->shouldReturn($category);
    }

    function its_year_is_mutable()
    {
        $this->setYear('1992')->shouldReturn($this);
        $this->getYear()->shouldReturn('1992');
    }
}
