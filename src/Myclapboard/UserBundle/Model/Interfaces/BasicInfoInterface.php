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

use Myclapboard\CoreBundle\Model\Interfaces\HumanInterface;

/**
 * Interface BasicInfoInterface.
 *
 * @package Myclapboard\UserBundle\Model\Interfaces
 */
interface BasicInfoInterface extends HumanInterface
{
    const GENDER_FEMALE = 'female';
    const GENDER_MALE = 'male';

    /**
     * Gets id.
     *
     * @return string
     */
    public function getId();

    /**
     * Sets gender.
     *
     * @param string $gender The gender that it can be 'female' or 'male'
     *
     * @return $this self Object
     */
    public function setGender($gender);

    /**
     * Gets gender.
     *
     * @return string
     */
    public function getGender();

    /**
     * Sets mobile.
     *
     * @param int $mobile The mobile
     *
     * @return $this self Object
     */
    public function setMobile($mobile);

    /**
     * Gets mobile.
     *
     * @return int
     */
    public function getMobile();

    /**
     * Sets phone.
     *
     * @param int $phone The phone
     *
     * @return $this self Object
     */
    public function setPhone($phone);

    /**
     * Gets phone.
     *
     * @return int
     */
    public function getPhone();
}
