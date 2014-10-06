<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Model\Traits;

/**
 * Trait DateTimeTrait.
 *
 * @package Myclapboard\CoreBundle\Model\Traits
 */
trait DateTimeTrait
{
    /**
     * Created date.
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Updated date.
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Sets created date.
     *
     * @param \DateTime $createdAt The created date
     *
     * @return $this self Object
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Gets created date.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Sets updated date.
     *
     * @param \DateTime $updatedAt The updated date
     *
     * @return $this self Object
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Gets updated date.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
