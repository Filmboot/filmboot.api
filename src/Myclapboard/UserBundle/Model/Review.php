<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\Model;

use Myclapboard\CoreBundle\Model\Traits\DateTimeTrait;
use Myclapboard\MovieBundle\Model\Interfaces\MovieInterface;
use Myclapboard\UserBundle\Model\Interfaces\AccountInterface;
use Myclapboard\UserBundle\Model\Interfaces\ReviewInterface;

/**
 * Class Review.
 *
 * @package Myclapboard\UserBundle\Model
 */
class Review implements ReviewInterface
{
    use DateTimeTrait;

    /**
     * The id.
     *
     * @var string
     */
    protected $id;

    /**
     * The content.
     *
     * @var string
     */
    protected $content;

    /**
     * The locale.
     *
     * @var string
     */
    protected $locale;

    /**
     * The movie.
     *
     * @var \Myclapboard\MovieBundle\Model\Interfaces\MovieInterface
     */
    protected $movie;

    /**
     * The title.
     *
     * @var string
     */
    protected $title;

    /**
     * The user.
     *
     * @var \Myclapboard\UserBundle\Model\Interfaces\AccountInterface
     */
    protected $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->locale = 'en';
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
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
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
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * {@inheritdoc}
     */
    public function setMovie(MovieInterface $movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
    public function setUser(AccountInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
