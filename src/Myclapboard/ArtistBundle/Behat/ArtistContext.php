<?php

namespace Myclapboard\ArtistBundle\Behat;

use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\ClientInterface;
use Myclapboard\ArtistBundle\Entity\ArtistTranslation;
use Myclapboard\CoreBundle\Behat\DefaultApiContext;

class ArtistContext extends DefaultApiContext
{
    /**
     * Loads artists used for testing to DB
     *
     * @Given /^the following artists exist:$/
     */
    public function theFollowingArtistsExist(TableNode $artists)
    {
        /** @var \Myclapboard\ArtistBundle\Manager\ArtistManager $repository */
        $repository = $this->getService('myclapboard_artist.manager.artist');

        /** @var \Doctrine\Bundle\DoctrineBundle\Registry $doctrine */
        $doctrine = $this->getService('doctrine');
        $birthplaceFinder = $doctrine->getRepository('JJsGeonamesBundle:City');
        $manager = $doctrine->getManager();

        foreach ($artists->getHash() as $artistValues) {
            /** @var \Myclapboard\ArtistBundle\Model\ArtistInterface $artist */
            $artist = $repository->create();
            $artist->setFirstName($artistValues['firstName']);
            $artist->setLastName($artistValues['lastName']);
            $artist->setBirthday(new \Datetime($artistValues['birthday']));

            $birthplace = $birthplaceFinder->findOneBy(array('geonameIdentifier' => $artistValues['birthplace']));
            $artist->setBirthplace($birthplace);

            $artist->setBiography($artistValues['biographyEn']);
            if ($artistValues['biographyEs'] !== null) {
                $translation = new ArtistTranslation('es', 'biography', $artistValues['biographyEs']);
                $artist->addTranslation($translation);
            }

            $manager->persist($artist);
        }
        $manager->flush();
    }
}
