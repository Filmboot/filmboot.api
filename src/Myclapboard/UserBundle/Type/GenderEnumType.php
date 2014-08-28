<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
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
