<?php

/**
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Myclapboard\AwardBundle\Command;

use Doctrine\Common\Persistence\ObjectManager;
use Myclapboard\AwardBundle\Entity\CategoryTranslation;
use Myclapboard\CoreBundle\Command\DataFixtureCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCategoriesCommand.
 *
 * @package Myclapboard\AwardBundle\Command
 */
class LoadCategoriesCommand extends DataFixtureCommand
{
    /**
     * {@inheritdoc}
     */
    protected $initMessage = 'Loading categories';

    /**
     * {@inheritdoc}
     */
    protected $endMessage = 'Categories loaded successfully';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('myclapboard:award:load:category')
            ->setDescription('Loads category from yml file')
            ->setHelp(
                'The <info>myclapboard:award:load:category</info> command loads content of file passed by argument
<info>php app/console myclapboard:award:load:category <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function hydrateFixture(ContainerInterface $container, ObjectManager $manager, $values)
    {
        $category = $container->get('myclapboard_award.manager.category')->create();

        $category->setName($values['en']);
        if ($values['es'] !== null) {
            $translation = new CategoryTranslation('es', 'name', $values['es']);
            $category->addTranslation($translation);
        }

        $manager->persist($category);
    }
}
