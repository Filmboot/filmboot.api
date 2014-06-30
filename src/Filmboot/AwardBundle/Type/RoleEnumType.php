<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmboot\AwardBundle\Type;

use Filmboot\MovieBundle\Type\BaseEnumType;

/**
 * Class RoleEnumType.
 *
 * @package Filmboot\AwardBundle\Type
 */
class RoleEnumType extends BaseEnumType
{
    protected $name = 'RoleEnum';
    protected $values = array('actor', 'director', 'writer');
} 
