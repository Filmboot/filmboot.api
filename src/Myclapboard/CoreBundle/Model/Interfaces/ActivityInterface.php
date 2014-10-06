<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model\Interfaces;

use Myclapboard\UserBundle\Model\Interfaces\RatingInterface;
use Myclapboard\UserBundle\Model\Interfaces\ReviewInterface;

/**
 * Interface ActivityInterface.
 *
 * @package Myclapboard\CoreBundle\Model\Interfaces
 */
interface ActivityInterface
{
    /**
     * Adds rating.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\RatingInterface $rating The rating
     *
     * @return $this self Object
     */
    public function addRating(RatingInterface $rating);

    /**
     * Removes rating.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\RatingInterface $rating The rating
     *
     * @return $this self Object
     */
    public function removeRating(RatingInterface $rating);

    /**
     * Gets ratings.
     *
     * @return array<\Myclapboard\UserBundle\Model\Interfaces\RatingInterface>
     */
    public function getRatings();

    /**
     * Adds review.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\ReviewInterface $review The review
     *
     * @return $this self Object
     */
    public function addReview(ReviewInterface $review);

    /**
     * Removes review.
     *
     * @param \Myclapboard\UserBundle\Model\Interfaces\ReviewInterface $review The review
     *
     * @return $this self Object
     */
    public function removeReview(ReviewInterface $review);

    /**
     * Gets reviews.
     *
     * @return array<\Myclapboard\UserBundle\Model\Interfaces\ReviewInterface>
     */
    public function getReviews();
}
