<?php

namespace Myclapboard\CoreBundle\Behat;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use JJs\Bundle\GeonamesBundle\Entity\City;
use JJs\Bundle\GeonamesBundle\Entity\Country;
use PHPUnit_Framework_Assert as Assertions;

class DefaultApiContext implements KernelAwareContext
{
    use KernelDictionary;

    /**
     * @BeforeScenario
     */
    public function purgeDatabase(BeforeScenarioScope $scope)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $this->getService('doctrine.orm.entity_manager');
        $entityManager->getConnection()->executeUpdate("SET foreign_key_checks = 0;");

        $purger = new ORMPurger($entityManager);
        $purger->purge();

        $entityManager->getConnection()->executeUpdate("SET foreign_key_checks = 1;");

        $this->loadTestCities();
    }

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function getService($id)
    {
        return $this->getContainer()->get($id);
    }

    /**
     * Loads a city to be used in tests
     */
    protected function loadTestCities()
    {
        $manager = $this->getService('doctrine')->getManager();

        $country = new Country();
        $country->setCode('AD');
        $country->setName('Andorra');
        $country->setDomain('ad');
        $country->setPostalCodeFormat('AD###');
        $country->setPostalCodeRegex('^(?:AD)*(\d{3})$');
        $country->setPhonePrefix(376);

        $manager->persist($country);

        $city = new City();
        $city->setCountry($country);
        $city->setTimezone(null);
        $city->setGeonameIdentifier(3038816);
        $city->setNameAscii('Xixerella');
        $city->setNameUtf8('Xixerella');
        $city->setLatitude(42.55327);
        $city->setLongitude(1.48736);

        $manager->persist($city);

        $manager->flush();
    }


}
