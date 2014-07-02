<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmbot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Filmbot\ArtistBundle\Command;

use Filmbot\ArtistBundle\Entity\ArtistTranslation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Parser;

/**
 * Class LoadArtistsCommand.
 *
 * @package Filmbot\ArtistBundle\Command
 */
class LoadArtistsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('filmbot:artist:load:artist')
            ->setDescription('Loads artist from yml file')
            ->addArgument('file', InputArgument::REQUIRED, 'Path of file to be loaded')
            ->setHelp(
                'The <info>filmbot:artist:load:artist</info> command loads content of file passed by argument 
<info>php app/console filmbot:artist:load:artist <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Loading artists");
        $this->loadArtists($input->getArgument('file'));
        $output->writeln("Artists loaded successfully");
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
            $artist = $container->get('filmbot_artist.manager.artist')->create();
            $birthplace = $doctrine->getRepository('JJsGeonamesBundle:City')
                ->findOneBy(array('geonameIdentifier' => $values['birthplace']));

            $artist->setFirstName($values['firstName']);
            $artist->setLastName($values['lastName']);
            $artist->setBirthday(new \DateTime($values['birthday']));
            $artist->setBirthplace($birthplace);
            $artist->setBiography($values['biography']['en']);
            if ($values['biography']['es']) {
                $translation = new ArtistTranslation('es', 'biography', $values['biography']['es']);
                $artist->addTranslation($translation);
            }
            $manager->persist($artist);
        }

        $manager->flush();
    }
}
