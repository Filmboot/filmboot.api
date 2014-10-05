<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\ArtistBundle\Command;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\ArtistBundle\Entity\ArtistTranslation;
use Myclapboard\CoreBundle\Command\DataFixtureCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class LoadArtistsCommand.
 *
 * @package Myclapboard\ArtistBundle\Command
 */
class LoadArtistsCommand extends DataFixtureCommand
{
    /**
     * {@inheritdoc}
     */
    protected $initMessage = 'Loading artists';

    /**
     * {@inheritdoc}
     */
    protected $endMessage = 'Artists loaded successfully';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('myclapboard:artist:load:artist')
            ->setDescription('Loads artist from yml file')
            ->setHelp(
                'The <info>myclapboard:artist:load:artist</info> command loads content of file passed by argument
<info>php app/console myclapboard:artist:load:artist <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function hydrateFixture(ContainerInterface $container, ObjectManager $manager, $values)
    {
        $artist = $container->get('myclapboard_artist.manager.artist')->create();
        $birthplace = $container->get('doctrine')->getRepository('JJsGeonamesBundle:City')
            ->findOneBy(array('geonameIdentifier' => $values['birthplace']));

        $artist->setFirstName($values['firstName']);
        $artist->setLastName($values['lastName']);
        $artist->setBirthday(new \DateTime($values['birthday']));
        $artist->setBirthplace($birthplace);
        $artist->setWebsite($values['website']);
        $artist->setBiography($values['biography']['en']);
        if ($values['biography']['es'] !== null) {
            $translation = new ArtistTranslation('es', 'biography', $values['biography']['es']);
            $artist->addTranslation($translation);
        }

        $this->linkedMainImage($artist, 'setPhoto', 'photos');
        $this->linkedOtherImages($artist, 'artist', 'setArtist', $manager);

        $manager->persist($artist);
    }

    /**
     * Adds the main image into resource.
     *
     * @param object $resource The resource object
     * @param string $method   The name of the method
     * @param string $path     The path
     *
     * @return void
     */
    protected function linkedMainImage($resource, $method, $path)
    {
        $image = $this->getContainer()->get('myclapboard_core.manager.baseImage')->create();

        $fileName = $resource->getSlug() . '.jpg';

        copy($image->getFixturePath($path) . $fileName, $image->getAbsolutePath() . $fileName);

        $resource->$method($fileName);

    }

    /**
     * Create resource's image object with the path and resource's slug given, adding into database.
     *
     * @param object                                     $resource The resource object
     * @param string                                     $class    The name of the class
     * @param string                                     $method   The name of the method
     * @param \Doctrine\Common\Persistence\ObjectManager $manager  The manager
     *
     * @return void
     */
    protected function linkedOtherImages($resource, $class, $method, $manager)
    {
        for ($i = 1; $i > 0; $i++) {
            $image = $this->getContainer()->get('myclapboard_' . $class . '.manager.image')->create();
            $absolutePath = $image->getFixturePath('images/' . $class . 's') . $resource->getSlug() . '-' . $i . '.jpg';

            if (file_exists($absolutePath) === true) {
                $fileName = $resource->getSlug() . '-' . uniqid() . '.jpg';

                copy($absolutePath, $image->getAbsolutePath() . $fileName);
                $file = new UploadedFile($image->getAbsolutePath() . $fileName, $fileName, null, null, null, true);
                $image->setName($fileName);
                $image->setFile($file);
                $image->$method($resource);
                $manager->persist($image);
            } else {
                $i = -1;
            }
        }
    }
}
