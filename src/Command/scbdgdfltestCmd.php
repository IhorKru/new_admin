<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Console\Input\InputArgument;

class scbdgdfltestCmd extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:gbdfltest')
            // the short description shown while running "php bin/console list"
            ->setDescription('get data from test gbdfl service through state credit bureau')
            //arguements that will be passed to below execute function
            ->addArgument('cntiin', InputArgument::REQUIRED, 'Number of IINS to check')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gbdflchecks = $this->getContainer()->get('gbdfl.test');
        $cntiin = $input->getArgument('cntiin');
        $gbdflchecks-> apiSCBGBDFLtestServiceAction($cntiin);
        $output->writeln('Whoa!' & $cntiin & 'checked');
    }
}