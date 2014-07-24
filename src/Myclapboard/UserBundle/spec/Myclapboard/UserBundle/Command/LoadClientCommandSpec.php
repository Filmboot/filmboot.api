<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace spec\Myclapboard\UserBundle\Command;

use FOS\OAuthServerBundle\Model\ClientInterface;
use FOS\OAuthServerBundle\Model\ClientManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadClientCommandSpec.
 *
 * @package spec\Myclapboard\UserBundle\Command
 */
class LoadClientCommandSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Myclapboard\UserBundle\Command\LoadClientCommand');
    }

    function it_extends_container_aware_command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    function it_executes(
        ContainerInterface $container,
        ClientManager $clientManager,
        ClientInterface $client,
        InputInterface $input,
        OutputInterface $output
    )
    {
        $container->get('fos_oauth_server.client_manager.default')
            ->shouldBeCalled()->willReturn($clientManager);
        $clientManager->createClient()
            ->shouldBeCalled()->willReturn($client);

        $input->bind(Argument::any())->shouldBeCalled();
        $input->isInteractive()->shouldBeCalled()->willReturn(false);
        $input->validate()->shouldBeCalled();

        $input->getOption('redirect-uri')
            ->shouldBeCalled()->willReturn(array('the-redirect-uri'));
        $client->setRedirectUris(array('the-redirect-uri'))->shouldBeCalled();

        $input->getOption('grant-type')
            ->shouldBeCalled()->willReturn(array('the-grant-type'));
        $client->setAllowedGrantTypes(array('the-grant-type'))->shouldBeCalled();
        
        $clientManager->updateClient($client)->shouldBeCalled();
        
        $client->getPublicId()->shouldBeCalled()->willReturn('public-id');
        $client->getSecret()->shouldBeCalled()->willReturn('secret');
        
        $output->writeln(
            sprintf(
                'Added a new client with public id <info>%s</info>, secret <info>%s</info>',
                'public-id',
                'secret'
            )
        )->shouldBeCalled();
        
        $this->run($input, $output);
    }
}
