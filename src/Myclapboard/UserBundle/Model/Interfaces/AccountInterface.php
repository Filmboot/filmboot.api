<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\Model\Interfaces;

/**
 * Interface AccountInterface.
 *
 * @package Myclapboard\UserBundle\Model\Interfaces
 */
interface AccountInterface extends BasicInfoInterface
{
    /**
     * Gets apiKey.
     *
     * @return string
     */
    public function getApiKey();

    /**
     * Sets apiKey.
     *
     * @param string $apiKey The apiKey to be set
     *
     * @return $this self Object
     */
    public function setApiKey($apiKey);

    /**
     * Gets locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Sets locale.
     *
     * @param string $locale The locale
     *
     * @return $this self Object
     */
    public function setLocale($locale);

    /**
     * Gets createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Gets true if has cookies accepted, otherwise gets false.
     *
     * @return boolean
     */
    public function hasCookiesAccepted();

    /**
     * Sets cookiesAccepted.
     *
     * @param boolean $cookiesAccepted The cookies accepted
     *
     * @return $this self Object
     */
    public function setCookiesAccepted($cookiesAccepted);

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
