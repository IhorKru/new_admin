<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

class adkCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:adkaction')

            // the short description shown while running "php bin/console list"
            ->setDescription('Command initiates request to ADK')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Command initiates request to ADK')
            //arguements that will be passed to below execute function
            ->addArgument('numcampaigns', InputArgument::REQUIRED, 'Number of emails in a batch')
            ->addArgument('timezone', InputArgument::REQUIRED, 'Timezone campaign is to be sent')
            ->addArgument('datedep', InputArgument::REQUIRED, 'Date/Time campaign is to be sent')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $adkcampaign = $this->getContainer()->get('api.adk');
        $numcampaigns = $input->getArgument('numcampaigns');
        $timezone = $input->getArgument('timezone');
        $depdate = $input->getArgument('datedep');
        $adkcampaign-> adkServiceAction($numcampaigns, $timezone, $depdate);
    }
}