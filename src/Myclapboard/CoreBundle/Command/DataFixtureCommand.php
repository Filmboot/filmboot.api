<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\CoreBundle\Command;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Parser;

/**
 * Class DataFixtureCommand.
 *
 * @package Myclapboard\CoreBundle\Command
 */
abstract class DataFixtureCommand extends ContainerAwareCommand
{
    /**
     * The init message.
     *
     * @var string
     */
    protected $initMessage;

    /**
     * The end message.
     *
     * @var string
     */
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
     * Loads all the objects from fixtures app folder.
     *
     * @param string $path The path of file
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
            $this->hydrateFixture($container, $manager, $values);
        }

        $manager->flush();
    }

    /**
     * Hydrates the entity with the fixture values.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container The container
     * @param \Doctrine\Common\Persistence\ObjectManager                $manager   The object manager
     * @param mixed[]                                                   $values    The values to add to entity
     *
     * @return void
     */
    abstract protected function hydrateFixture(ContainerInterface $container, ObjectManager $manager, $values);
}
