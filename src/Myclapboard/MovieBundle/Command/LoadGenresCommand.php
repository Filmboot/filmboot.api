<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\MovieBundle\Command;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\CoreBundle\Command\DataFixtureCommand;
use Myclapboard\MovieBundle\Entity\GenreTranslation;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadGenresCommand.
 *
 * @package Myclapboard\MovieBundle\Command
 */
class LoadGenresCommand extends DataFixtureCommand
{
    /**
     * {@inheritdoc}
     */
    protected $initMessage = 'Loading genres';

    /**
     * {@inheritdoc}
     */
    protected $endMessage = 'Genres loaded successfully';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('myclapboard:movie:load:genre')
            ->setDescription('Loads genre from yml file')
            ->setHelp(
                'The <info>myclapboard:movie:load:genre</info> command loads content of file passed by argument
<info>php app/console myclapboard:movie:load:genre <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function hydrateFixture(ContainerInterface $container, ObjectManager $manager, $values)
    {
        $genre = $container->get('myclapboard_movie.manager.genre')->create();

        $genre->setName($values['en']);
        if ($values['es'] !== null) {
            $translation = new GenreTranslation('es', 'name', $values['es']);
            $genre->addTranslation($translation);
        }
        $manager->persist($genre);
    }
}
