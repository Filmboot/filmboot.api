<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\Type;

use Myclapboard\MovieBundle\Type\BaseEnumType;

/**
 * Class RoleEnumType.
 *
 * @package Myclapboard\AwardBundle\Type
 */
class RoleEnumType extends BaseEnumType
{
    protected $name = 'RoleEnum';
    protected $values = array('actor', 'director', 'writer');
}
