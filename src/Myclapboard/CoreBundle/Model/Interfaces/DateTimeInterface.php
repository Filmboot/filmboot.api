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

/**
 * Interface DateTimeInterface.
 *
 * @package Myclapboard\CoreBundle\Model\Interfaces
 */
interface DateTimeInterface
{
    /**
     * Sets created date.
     *
     * @param \DateTime $createdAt The created date
     *
     * @return $this self Object
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Gets created date.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Sets updated date.
     *
     * @param \DateTime $updatedAt The updated date
     *
     * @return $this self Object
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Gets updated date.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
}
