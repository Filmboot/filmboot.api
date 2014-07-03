<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\AwardBundle\Type;

use Filmbot\MovieBundle\Type\BaseEnumType;

/**
 * Class RoleEnumType.
 *
 * @package Filmbot\AwardBundle\Type
 */
class RoleEnumType extends BaseEnumType
{
    protected $name = 'RoleEnum';
    protected $values = array('actor', 'director', 'writer');
}
