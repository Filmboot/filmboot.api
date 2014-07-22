<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\ArtistBundle\Command;

use Myclapboard\ArtistBundle\Entity\ArtistTranslation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Yaml\Parser;

/**
 * Class LoadArtistsCommand.
 *
 * @package Myclapboard\ArtistBundle\Command
 */
class LoadArtistsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('myclapboard:artist:load:artist')
            ->setDescription('Loads artist from yml file')
            ->addArgument('file', InputArgument::REQUIRED, 'Path of file to be loaded')
            ->setHelp(
                'The <info>myclapboard:artist:load:artist</info> command loads content of file passed by argument 
<info>php app/console myclapboard:artist:load:artist <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Loading artists');
        $this->loadArtists($input->getArgument('file'));
        $output->writeln('Artists loaded successfully');
    }

    /**
     * Loads all the artists from fixtures app folder
     *
     * @param string $path The path of file
     *
     * @return void
     */
    public function loadArtists($path)
    {
        $yaml = new Parser();

        $fixtures = $yaml->parse(file_get_contents($path));

        $container = $this->getContainer();
        $doctrine = $container->get('doctrine');
        $manager = $doctrine->getManager();
        foreach ($fixtures as $values) {
            $artist = $container->get('myclapboard_artist.manager.artist')->create();
            $birthplace = $doctrine->getRepository('JJsGeonamesBundle:City')
                ->findOneBy(array('geonameIdentifier' => $values['birthplace']));

            $artist->setFirstName($values['firstName']);
            $artist->setLastName($values['lastName']);
            $artist->setBirthday(new \DateTime($values['birthday']));
            $artist->setBirthplace($birthplace);
            $artist->setWebsite($values['website']);
            $artist->setBiography($values['biography']['en']);
            if ($values['biography']['es']) {
                $translation = new ArtistTranslation('es', 'biography', $values['biography']['es']);
                $artist->addTranslation($translation);
            }

            $this->linkedMainImage($artist, 'setPhoto', 'photos');
            $this->linkedOtherImages($artist, 'artist', 'setArtist', $manager);

            $manager->persist($artist);
        }

        $manager->flush();
    }

    /**
     * Adds the main image into resource.
     *
     * @param mixed  $resource The resource object
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
     * @param mixed                                      $resource The resource object
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
