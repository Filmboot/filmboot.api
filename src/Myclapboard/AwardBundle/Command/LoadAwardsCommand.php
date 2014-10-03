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
use Myclapboard\CoreBundle\Command\DataFixtureCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LoadAwardsCommand.
 *
 * @package Myclapboard\AwardBundle\Command
 */
class LoadAwardsCommand extends DataFixtureCommand
{
    protected $factory = 'myclapboard_award.manager.award';
    protected $initMessage = 'Loading awards';
    protected $endMessage =  'Awards loaded successfully';

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
    protected function hydrateFixture($entity, $values)
    {
        $entity->setName($values['en']);
        if ($values['es'] !== null) {
            $translation = new AwardTranslation('es', 'name', $values['es']);
            $entity->addTranslation($translation);
        }

        return $entity;
    }
}
