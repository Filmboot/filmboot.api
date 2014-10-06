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
use Myclapboard\CoreBundle\Model\Traits\ActivityTrait;
use Myclapboard\CoreBundle\Model\Traits\MediaTrait;
use Myclapboard\CoreBundle\Model\Traits\RolesTrait;
use Myclapboard\CoreBundle\Model\Traits\TranslatableTrait;
use Myclapboard\MovieBundle\Model\Interfaces\GenreInterface;
use Myclapboard\MovieBundle\Model\Interfaces\ImageInterface;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use Myclapboard\MovieBundle\Util\Util;

/**
 * Class Movie model.
 *
 * @package Myclapboard\MovieBundle\Model
 */
class Movie implements MovieInterface
{
    use ActivityTrait;
    use MediaTrait;
    use RolesTrait;
    use TranslatableTrait;

    /**
     * The id.
     *
     * @var string
     */
    protected $id;

    /**
     * The slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * The title.
     *
     * @var string
     */
    protected $title;

    /**
     * The duration in minutes.
     *
     * @var int
     */
    protected $duration;

    /**
     * The release date.
     *
     * @var \DateTime
     */
    protected $releaseDate;

    /**
     * The country.
     *
     * @var string
     */
    protected $country;

    /**
     * The storyline.
     *
     * @var string
     */
    protected $storyline;

    /**
     * The producer.
     *
     * @var string
     */
    protected $producer;

    /**
     * Array that contains genres.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $genres;

    /**
     * Array that contains awards.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $awards;

    /**
     * Array that contains images.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $images;

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
        $this->awards = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->images = new ArrayCollection();

        $this->ratings = new ArrayCollection();
        $this->reviews = new ArrayCollection();

        $this->translations = new ArrayCollection();

        $this->actors = new ArrayCollection();
        $this->directors = new ArrayCollection();
        $this->writers = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
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
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
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
    public function getDuration()
    {
        return $this->duration;
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
    public function getReleaseDate()
    {
        return $this->releaseDate;
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
    public function getCountry()
    {
        return $this->country;
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
    public function getStoryline()
    {
        return $this->storyline;
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
    public function getProducer()
    {
        return $this->producer;
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
    public function addImage(ImageInterface $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ImageInterface $image)
    {
        $this->images->removeElement($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->title;
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
}
