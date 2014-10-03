<?php

namespace Myclapboard\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Parser;

/**
 * Class DataFixtureCommand.
 *
 * @package Myclapboard\CoreBundle\Command
 */
abstract class DataFixtureCommand extends ContainerAwareCommand
{
    protected $factory;

    protected $initMessage;

    protected $endMessage;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->addArgument('file', InputArgument::REQUIRED, 'Path of file to be loaded');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->initMessage);
        $this->loadEntity($input->getArgument('file'));
        $output->writeln($this->endMessage);
    }

    /**
     * Loads all the awards from fixtures app folder.
     *
     * @param string $path    The path of file
     *
     * @return void
     */
    public function loadEntity($path)
    {
        $yaml = new Parser();

        $fixtures = $yaml->parse(file_get_contents($path));

        $container = $this->getContainer();
        $doctrine = $container->get('doctrine');
        $manager = $doctrine->getManager();
        foreach ($fixtures as $values) {
            $entity = $container->get($this->factory)->create();

            $entity = $this->hydrateFixture($entity, $values);

            $manager->persist($entity);
        }

        $manager->flush();
    }

    /**
     * @param object $entity Entity to hydrate
     * @param array  $values values to add to entity
     */
    abstract protected function hydrateFixture($entity, $values);
} 