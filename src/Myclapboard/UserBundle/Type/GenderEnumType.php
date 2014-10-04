<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\UserBundle\Type;

use Myclapboard\CoreBundle\Type\BaseEnumType;

/**
 * Class GenderEnumType.
 *
 * @package Myclapboard\UserBundle\Type
 */
class GenderEnumType extends BaseEnumType
{
    protected $name = 'GenderEnum';
    protected $values = array(null, 'female', 'male');
}
