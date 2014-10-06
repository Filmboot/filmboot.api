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

use Myclapboard\CoreBundle\Model\Interfaces\ActivityInterface;

/**
 * Interface AccountInterface.
 *
 * @package Myclapboard\UserBundle\Model\Interfaces
 */
interface AccountInterface extends BasicInfoInterface, ActivityInterface
{
    /**
     * Sets apiKey.
     *
     * @param string $apiKey The apiKey to be set
     *
     * @return $this self Object
     */
    public function setApiKey($apiKey);

    /**
     * Gets apiKey.
     *
     * @return string
     */
    public function getApiKey();

    /**
     * Sets locale.
     *
     * @param string $locale The locale
     *
     * @return $this self Object
     */
    public function setLocale($locale);

    /**
     * Gets locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Sets cookiesAccepted.
     *
     * @param boolean $cookiesAccepted The cookies accepted
     *
     * @return $this self Object
     */
    public function setCookiesAccepted($cookiesAccepted);

    /**
     * Gets true if has cookies accepted, otherwise gets false.
     *
     * @return boolean
     */
    public function hasCookiesAccepted();

    /**
     * Gets createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt();
}
