<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\UserBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Account.
 *
 * @package Myclapboard\UserBundle\Model
 */
class Account extends BasicInfo implements AccountInterface
{
    protected $apiKey;

    protected $locale;

    protected $createdAt;

    protected $cookiesAccepted;

    protected $ratings;

    protected $reviews;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->locale = 'en';
        $this->createdAt = new \Datetime();
        $this->cookiesAccepted = false;
        $this->ratings = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCookiesAccepted()
    {
        return $this->cookiesAccepted;
    }

    /**
     * {@inheritdoc}
     */
    public function setCookiesAccepted($cookiesAccepted)
    {
        $this->cookiesAccepted = $cookiesAccepted;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addRating(RatingInterface $rating)
    {
        $this->ratings[] = $rating;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeRating(RatingInterface $rating)
    {
        $this->ratings->removeElement($rating);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * {@inheritdoc}
     */
    public function addReview(ReviewInterface $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeReview(ReviewInterface $review)
    {
        $this->reviews->removeElement($review);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReviews()
    {
        return $this->reviews;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->setUsername($email);
        parent::setEmail($email);
    }
}
