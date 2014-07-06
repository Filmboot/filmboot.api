<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to Filmboot.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\MovieBundle\Command;

use Myclapboard\MovieBundle\Entity\GenreTranslation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Parser;

/**
 * Class LoadGenresCommand.
 *
 * @package Myclapboard\MovieBundle\Command
 */
class LoadGenresCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('myclapboard:movie:load:genre')
            ->setDescription('Loads genre from yml file')
            ->addArgument('file', InputArgument::REQUIRED, 'Path of file to be loaded')
            ->setHelp(
                'The <info>myclapboard:movie:load:genre</info> command loads content of file passed by argument 
<info>php app/console myclapboard:movie:load:genre <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Loading genres");
        $this->loadGenres($input->getArgument('file'));
        $output->writeln("Genres loaded successfully");
    }

    /**
     * Loads all the genres from fixtures app folder
     *
     * @param string $path The path of file
     *
     * @return void
     */
    public function loadGenres($path)
    {
        $yaml = new Parser();

        $fixtures = $yaml->parse(file_get_contents($path));

        $container = $this->getContainer();
        $doctrine = $container->get('doctrine');
        $manager = $doctrine->getManager();
        foreach ($fixtures as $values) {
            $genre = $container->get('myclapboard_movie.manager.genre')->create();

            $genre->setName($values['en']);
            if ($values['es']) {
                $translation = new GenreTranslation('es', 'name', $values['es']);
                $genre->addTranslation($translation);
            }
            $manager->persist($genre);
        }

        $manager->flush();
    }
}
