<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\RateLimiter\RateLimiterFactory;

#[AsCommand('app:rate-limit')]
class TestRateLimitCommand extends Command
{
    public function __construct(private readonly RateLimiterFactory $emailOutputLimitLimiter)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $limit = $this->emailOutputLimitLimiter->create();

        $io->info('Without additional consume');
        for ($i = 0; $i <= 5; $i++) {
            $limit->reserve()->wait();
            $io->writeln(sprintf('%s: %s', (new \DateTime())->format('H:i:s'), $i));
        }

        usleep(4000); // Let window fill
        $io->info('With additional consume');
        for ($i = 0; $i <= 5; $i++) {
            $limit->reserve()->wait();
            $limit->consume();
            $io->writeln(sprintf('%s: %s', (new \DateTime())->format('H:i:s'), $i));
        }

        return Command::SUCCESS;
    }
}
