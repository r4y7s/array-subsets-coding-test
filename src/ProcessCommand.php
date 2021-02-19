<?php
declare(strict_types=1);

namespace Subsets;

use Subsets\Service\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ProcessCommand extends Command
{
    protected function configure()
    {
        $this->setName('subsets')
            ->setDescription('Generates all the subsets of size k');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->setVerbosity(OutputInterface::VERBOSITY_DEBUG);
        $logger = new ConsoleLogger($output);

        list($end, $k) = $this->getLengthOfArrayAndValueOfK($input, $output);
        $s = range(1, $end);

        $logger->info("Init with s=" . json_encode($s) . " and k={$k}");

        $output = (new Generator)->make($s, $k);

        $logger->info("Output: " . json_encode($output));

        return Command::SUCCESS;
    }

    private function getLengthOfArrayAndValueOfK(InputInterface $input, OutputInterface $output): array
    {
        $helper = $this->getHelper('question');

        $validatorInteger = function ($answer) {
            if (!ctype_digit($answer)) {
                throw new \RuntimeException('Is not integer');
            }
            return $answer;
        };

        $sLength = new Question('Please enter the length of array s: ', 4);
        $sLength->setValidator($validatorInteger);
        $length = (int)$helper->ask($input, $output, $sLength);

        $valueOfK = new Question('Please enter the value of k parameter: ', 1);
        $valueOfK->setValidator($validatorInteger);
        $k = (int)$helper->ask($input, $output, $valueOfK);

        return [$length, $k];
    }
}
