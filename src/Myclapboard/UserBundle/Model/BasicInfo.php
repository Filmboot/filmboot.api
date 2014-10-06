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

use FOS\UserBundle\Model\User as BaseUser;
use Myclapboard\CoreBundle\Model\Traits\HumanTrait;
use Myclapboard\UserBundle\Model\Interfaces\BasicInfoInterface;

/**
 * Class BasicInfo.
 *
 * @package Myclapboard\UserBundle\Model
 */
class BasicInfo extends BaseUser implements BasicInfoInterface
{
    use HumanTrait;

    /**
     * The gender that it can be 'female' or 'male'
     *
     * @var string
     */
    protected $gender;

    /**
     * The mobile phone number.
     *
     * @var int
     */
    protected $mobile;

    /**
     * The phone number.
     *
     * @var int
     */
    protected $phone;

    /**
     * {@inheritdoc}
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * {@inheritdoc}
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * {@inheritdoc}
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * {@inheritdoc}
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * String representation of a BasicInfo.
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->firstName !== null && $this->lastName !== null) {
            return $this->firstName . ' ' . $this->lastName;
        }

        if ($this->firstName !== null) {
            return $this->firstName;
        }

        if ($this->lastName !== null) {
            return $this->lastName;
        }

        return $this->email;
    }
}
