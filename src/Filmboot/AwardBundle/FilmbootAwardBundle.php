<?php

namespace Filmboot\AwardBundle;

use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class FilmbootAwardBundle.
 *
 * @package Filmboot\AwardBundle
 */
class FilmbootAwardBundle extends Bundle
{
    public function boot()
    {
        $connection = $this->container->get('doctrine')->getConnection();

        if (!Type::hasType('RoleEnum')) {
            Type::addType('RoleEnum', 'Filmboot\AwardBundle\Type\RoleEnumType');
            $connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
