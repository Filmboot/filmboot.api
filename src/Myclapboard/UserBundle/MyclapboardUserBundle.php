<?php

namespace Myclapboard\UserBundle;

use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MyclapboardUserBundle.
 *
 * @package Myclapboard\UserBundle
 */
class MyclapboardUserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $connection = $this->container->get('doctrine')->getConnection();

        if (!Type::hasType('GenderEnum')) {
            Type::addType('GenderEnum', 'Myclapboard\UserBundle\Type\GenderEnumType');
            $connection->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
