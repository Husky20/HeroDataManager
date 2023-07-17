<?php

namespace App\Command;

use App\Service\FilmService;
use App\Service\PeopleService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchAllPeopleDataCommand extends Command
{
    protected static $defaultName = 'app:fetch-all-people';

    private PeopleService $peopleService;

    /**
     * @param PeopleService $peopleService
     */
    public function __construct(PeopleService $peopleService)
    {
        parent::__construct();
        $this->peopleService = $peopleService;
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Fetches and saves all people data from the API.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->peopleService->fetchAndSavePeople();
            $output->writeln('Data for all people has been fetched and saved.');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('An error occurred: '.$e->getMessage());

            return Command::FAILURE;
        }
    }
}
