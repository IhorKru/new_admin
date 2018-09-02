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

class gcheckCommand  extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:checkgender')
            // the short description shown while running "php bin/console list"
            ->setDescription('maps gender for the given first name')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows checking gender for distinct names')
            ->addArgument('numchecks', InputArgument::REQUIRED, 'Input number of names we would like to check')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $emailcheck = $this->getContainer()->get('email.check');
        $numemails = $input->getArgument('numchecks');
        $emailcheck-> emailCheckServiceAction($numchecks);
        $output->writeln('Check completed!');
    }
}