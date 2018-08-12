<?php
/**
 * Created by PhpStorm.
 * User: IKRUCHYNENKO
 * Date: 22-Jan-18
 * Time: 01:45 PM
 */
namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Console\Input\InputArgument;

class echeckCommand  extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:checkemails')
            // the short description shown while running "php bin/console list"
            ->setDescription('check email addresses for validity')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows update all stats on overall dashboard')
            ->addArgument('numemails', InputArgument::REQUIRED, 'Input update period')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $emailcheck = $this->getContainer()->get('email.check');
        $numemails = $input->getArgument('numemails');
        $emailcheck-> emailCheckServiceAction($numemails);
        $output->writeln('Check completed!');
    }
}