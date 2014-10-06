<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\MovieBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use JJs\Bundle\GeonamesBundle\Entity\Country;
use Myclapboard\AwardBundle\Model\Interfaces\AwardWonInterface;
use Myclapboard\CoreBundle\Model\Abstracts\AbstractBaseModel;
use Myclapboard\CoreBundle\Model\Traits\ActivityTrait;
use Myclapboard\CoreBundle\Model\Traits\CollectionTrait;
use Myclapboard\CoreBundle\Model\Traits\MediaTrait;
use Myclapboard\CoreBundle\Model\Traits\TranslatableTrait;
use Myclapboard\MovieBundle\Model\Interfaces\GenreInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use Myclapboard\MovieBundle\Util\Util;

/**
 * Class Movie model.
 *
 * @package Myclapboard\MovieBundle\Model
 */
class Movie extends AbstractBaseModel implements MovieInterface
{
    use ActivityTrait;
    use CollectionTrait;
    use MediaTrait;
    use TranslatableTrait;

    /**
     * Array that contains awards.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $awards;

    /**
     * The country.
     *
     * @var string
     */
    protected $country;

    /**
     * The duration in minutes.
     *
     * @var int
     */
    protected $duration;

    /**
     * Array that contains genres.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $genres;

    /**
     * The producer.
     *
     * @var string
     */
    protected $producer;

    /**
     * The slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * The storyline.
     *
     * @var string
     */
    protected $storyline;

    /**
     * The release date.
     *
     * @var \DateTime
     */
    protected $releaseDate;

    /**
     * The title.
     *
     * @var string
     */
    protected $title;

    /**
     * The average of marks.
     *
     * @var float
     */
    protected $score;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->awards = new ArrayCollection();
        $this->directors = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->writers = new ArrayCollection();

        $this->ratings = new ArrayCollection();
        $this->reviews = new ArrayCollection();

        $this->translations = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function addAward(AwardWonInterface $award)
    {
        $this->awards[] = $award;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAward(AwardWonInterface $award)
    {
        $this->awards->removeElement($award);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * {@inheritdoc}
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * {@inheritdoc}
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * {@inheritdoc}
     */
    public function addGenre(GenreInterface $genre)
    {
        $this->genres[] = $genre;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeGenre(GenreInterface $genre)
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * {@inheritdoc}
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * {@inheritdoc}
     */
    public function setReleaseDate(\DateTime $releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * {@inheritdoc}
     */
    public function calculateScore()
    {
        $this->score = '-';
        $length = $this->ratings->count();

        $sumOfScores = 0;
        foreach ($this->ratings as $rating) {
            $sumOfScores = $sumOfScores + $rating->getMark();
        }

        if ($length !== 0) {
            $this->score = $sumOfScores / $length;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritdoc}
     */
    public function setStoryline($storyline)
    {
        $this->storyline = $storyline;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStoryline()
    {
        return $this->storyline;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->slug = Util::getSlug($title);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }
}
