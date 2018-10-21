<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Console\Input\InputArgument;

class statsCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:updatestats')
            // the short description shown while running "php bin/console list"
            ->setDescription('Update all stats on overall dashboard')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows update all stats on overall dashboard')
            //arguements that will be passed to below execute function
            ->addArgument('period', InputArgument::REQUIRED, 'Input update period')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $request = Request::createFromGlobals();
        $allstats = $this->getContainer()->get('all.stats');
        $period = $input->getArgument('period');
        if ($period == 'd') {
            $allstats ->statsServiceAction($request, 'daily');
        } elseif ($period == 'w') {
            $allstats ->statsServiceAction($request, 'weekly');
        } elseif ($period == 'm') {
            $allstats ->statsServiceAction($request, 'monthly');
        } elseif ($period == 'a') {
            $allstats ->statsServiceAction($request, 'yearly');
        } else {
            $allstats ->statsServiceAction($request, 'daily');
            $allstats ->statsServiceAction($request, 'weekly');
            $allstats ->statsServiceAction($request, 'monthly');
            $allstats ->statsServiceAction($request, 'yearly');
        }
        $output->writeln('Whoa!' & $period);
    }
}