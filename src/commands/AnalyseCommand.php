<?php
/**
 * @author Liam
 */

namespace Foxhound\Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AnalyseCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('analyse')
            ->setDescription('Run analysis against your code base.')
            ->addArgument(
                'input',
                InputArgument::OPTIONAL,
                'Path to the code you wish to test.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $input_path = $input->getArgument('input');

        if (!$input_path) {
            $input_path = __DIR__;
        }

        $text = 'Analyse: ' . $input_path;

        $output->writeln($text);
    }
}
