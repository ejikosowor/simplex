<?php

namespace App\Simplex\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class CreateModelCommand extends Command
{    
    protected $fileSystem;

    protected $basePath = 'app\Models\\';

    public function __construct()
    {
        $this->fileSystem = new Filesystem();

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('make:model')
            ->setDescription('Creates a new Model/Entity.')
            ->setHelp('This command allows you to create a new Model/Entity')
            ->addArgument('model', InputArgument::REQUIRED, 'Model/Entity NAME');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->createModel($input, $output);
    }

    private function createModel(InputInterface $input, OutputInterface $output)
    {   
        $io = new SymfonyStyle($input, $output);
        $model = $this->basePath . $input->getArgument('model') . '.php';

        if(!$this->fileSystem->exists($model)) {           
            try {    
                $this->fileSystem->touch($model);
                $io->success($input->getArgument('model') . ' ' . $this->getStatusMessage('success'));
            } catch (IOExceptionInterface $exception) {
                $io->error($exception->getMessage());
            }

        } else {
            $io->error($this->getStatusMessage('exists'));            
        }
    }

    private function getStatusMessage($key)
    {
        $message = [
            'success' => 'Created Successfully',
            'error' => 'Could not create Model',
            'exists' => 'Model Already Exists'
        ];

        return $message[$key];
    }

}