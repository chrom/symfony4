<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleStatsCommand extends Command
{
    protected static $defaultName = 'article:stats';

    protected function configure()
    {
        $this
            ->setDescription('Return some article stats')
            ->addArgument('slug', InputArgument::REQUIRED, 'The article\'s slug ')
            ->addOption('format', 'f', InputOption::VALUE_REQUIRED, 'The output format', 'text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');

        $data = [
            'slug' => $slug,
            'stars' => rand(10, 100)
        ];

        switch ($input->getOption('format')){
            case 'text':
                $rows = [];
                foreach ($data as $key => $val) {
                    $rows[] = [$key, $val];
                }

                $io->table(['Key', 'Value'], $rows);
                break;
            case 'json':
                $io->write(\GuzzleHttp\json_encode($data));
                break;
            default:
                throw new \Exception('What kind of crazy format is that?');
        }

//        $io->success('./bin/console article:stats hey -f json');
    }
}
