<?php

namespace Filmbot\AwardBundle;

use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class FilmbotAwardBundle.
 *
 * @package Filmbot\AwardBundle
 */
class FilmbotAwardBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $connection = $this->container->get('doctrine')->getConnection();

        if (!Type::hasType('RoleEnum')) {
            Type::addType('RoleEnum', 'Filmbot\AwardBundle\Type\RoleEnumType');
            $connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
