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
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Class Account.
 *
 * @package Myclapboard\UserBundle\Model
 */
class Account extends BasicInfo implements AdvancedUserInterface, AccountInterface
{
    protected $password;

    protected $salt;

    protected $role;

    protected $locale;

    protected $createdAt;

    protected $lastLogin;

    protected $activated;

    protected $cookiesAccepted;

    protected $ratings;

    protected $reviews;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->locale = 'en';
        $this->createdAt = new \Datetime();
        $this->activated = false;
        $this->cookiesAccepted = false;
        $this->ratings = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->hasActivated();
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return array($this->role);
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * {@inheritdoc}
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * {@inheritdoc}
     */
    public function setRole($role)
    {
        $this->role = $role;

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
    public function hasActivated()
    {
        return $this->activated;
    }

    /**
     * {@inheritdoc}
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;

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
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastLogin(\DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
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
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
}
