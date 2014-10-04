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
use Myclapboard\AwardBundle\Entity\AwardTranslation;
use Myclapboard\CoreBundle\Command\DataFixtureCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadAwardsCommand.
 *
 * @package Myclapboard\AwardBundle\Command
 */
class LoadAwardsCommand extends DataFixtureCommand
{
    /**
     * {@inheritdoc}
     */
    protected $initMessage = 'Loading awards';

    /**
     * {@inheritdoc}
     */
    protected $endMessage = 'Awards loaded successfully';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('myclapboard:award:load:award')
            ->setDescription('Loads award from yml file')
            ->setHelp(
                'The <info>myclapboard:award:load:award</info> command loads content of file passed by argument
<info>php app/console myclapboard:award:load:award <path-of-file></info>'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function hydrateFixture(ContainerInterface $container, ObjectManager $manager, $values)
    {
        $award = $container->get('myclapboard_award.manager.award')->create();

        $award->setName($values['en']);
        if ($values['es'] !== null) {
            $translation = new AwardTranslation('es', 'name', $values['es']);
            $award->addTranslation($translation);
        }

        $manager->persist($award);
    }
}
