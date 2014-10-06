<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model\Traits;

use Myclapboard\UserBundle\Model\Interfaces\RatingInterface;
use Myclapboard\UserBundle\Model\Interfaces\ReviewInterface;

/**
 * Trait ActivityTrait.
 *
 * @package Myclapboard\CoreBundle\Model\Traits
 */
trait ActivityTrait
{
    /**
     * Array that contains ratings.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $ratings;

    /**
     * Array that contains reviews.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $reviews;

    /**
     * Adds rating.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\RatingInterface $rating The rating
     *
     * @return $this self Object
     */
    public function addRating(RatingInterface $rating)
    {
        $this->ratings[] = $rating;

        return $this;
    }

    /**
     * Removes rating.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\RatingInterface $rating The rating
     *
     * @return $this self Object
     */
    public function removeRating(RatingInterface $rating)
    {
        $this->ratings->removeElement($rating);

        return $this;
    }

    /**
     * Gets ratings.
     *
     * @return array<\Myclapboard\UserBundle\Model\Interfaces\RatingInterface>
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * Adds review.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\ReviewInterface $review The review
     *
     * @return $this self Object
     */
    public function addReview(ReviewInterface $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Removes review.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\ReviewInterface $review The review
     *
     * @return $this self Object
     */
    public function removeReview(ReviewInterface $review)
    {
        $this->reviews->removeElement($review);

        return $this;
    }

    /**
     * Gets reviews.
     *
     * @return array<\Myclapboard\UserBundle\Model\Interfaces\ReviewInterface>
     */
    public function getReviews()
    {
        return $this->reviews;
    }
}
