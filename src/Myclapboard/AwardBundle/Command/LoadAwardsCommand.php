<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\AwardBundle\Command;

use Myclapboard\AwardBundle\Entity\AwardTranslation;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Parser;

/**
 * Class LoadAwardsCommand.
 *
 * @package Myclapboard\AwardBundle\Command
 */
class LoadAwardsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('myclapboard:award:load:award')
            ->setDescription('Loads award from yml file')
            ->addArgument('file', InputArgument::REQUIRED, 'Path of file to be loaded')
            ->setHelp(
                'The <info>myclapboard:award:load:award</info> command loads content of file passed by argument 
<info>php app/console myclapboard:award:load:award <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Loading awards");
        $this->loadAwards($input->getArgument('file'));
        $output->writeln("Awards loaded successfully");
    }

    /**
     * Loads all the awards from fixtures app folder
     *
     * @param string $path The path of file
     *
     * @return void
     */
    public function loadAwards($path)
    {
        $yaml = new Parser();

        $fixtures = $yaml->parse(file_get_contents($path));

        $container = $this->getContainer();
        $doctrine = $container->get('doctrine');
        $manager = $doctrine->getManager();
        foreach ($fixtures as $values) {
            $award = $container->get('myclapboard_award.manager.award')->create();

            $award->setName($values['en']);
            if ($values['es']) {
                $translation = new AwardTranslation('es', 'name', $values['es']);
                $award->addTranslation($translation);
            }
            
            $manager->persist($award);
        }

        $manager->flush();
    }
}
