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

use Doctrine\Common\Collections\ArrayCollection;
use Myclapboard\CoreBundle\Model\Traits\ActivityTrait;
use Myclapboard\UserBundle\Model\Interfaces\AccountInterface;

/**
 * Class Account.
 *
 * @package Myclapboard\UserBundle\Model
 */
class Account extends BasicInfo implements AccountInterface
{
    use ActivityTrait;

    /**
     * The api key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Boolean that tells the cookies are accepted or not.
     *
     * @var bool
     */
    protected $cookiesAccepted;

    /**
     * Created at.
     *
     * @var \Datetime
     */
    protected $createdAt;

    /**
     * The locale.
     *
     * @var string
     */
    protected $locale;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->cookiesAccepted = false;
        $this->createdAt = new \Datetime();
        $this->locale = 'en';
        $this->ratings = new ArrayCollection();
        $this->reviews = new ArrayCollection();
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
    public function hasCookiesAccepted()
    {
        return $this->cookiesAccepted;
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
    public function setEmail($email)
    {
        $this->setUsername($email);
        parent::setEmail($email);
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
}
