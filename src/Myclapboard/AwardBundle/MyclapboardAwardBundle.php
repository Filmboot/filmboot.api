<?php

namespace Myclapboard\AwardBundle;

use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MyclapboardAwardBundle.
 *
 * @package Myclapboard\AwardBundle
 */
class MyclapboardAwardBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $connection = $this->container->get('doctrine')->getConnection();

        if (!Type::hasType('RoleEnum')) {
            Type::addType('RoleEnum', 'Myclapboard\AwardBundle\Type\RoleEnumType');
            $connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
