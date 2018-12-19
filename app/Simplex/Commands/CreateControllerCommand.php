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

class CreateControllerCommand extends Command
{    
    protected $fileSystem;

    protected $basePath = 'app\Controllers\\';

    public function __construct()
    {
        $this->fileSystem = new Filesystem();

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('make:controller')
            ->setDescription('Creates a new controller.')
            ->setHelp('This command allows you to create a new controller')
            ->addArgument('controller', InputArgument::REQUIRED, 'Controller NAME')
            ->addArgument('path', InputArgument::OPTIONAL, 'Controller PATH');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->createController($input, $output);
    }

    private function createController(InputInterface $input, OutputInterface $output)
    {   
        $io = new SymfonyStyle($input, $output);

        $this->createControllerPath($io, $input, $output);

        $controller = $this->basePath . $input->getArgument('path') . '\\' . $input->getArgument('controller') . '.php';

        if(!$this->fileSystem->exists($controller)) {           
            try {    
                $this->fileSystem->touch($controller);
                $io->success($input->getArgument('controller') . ' ' . $this->getStatusMessage('success'));
            } catch (IOExceptionInterface $exception) {
                $io->error($exception->getMessage());
            }

        } else {
            $io->error($this->getStatusMessage('exists'));            
        }
    }

    private function createControllerPath(SymfonyStyle $io, InputInterface $input, OutputInterface $output)
    {
        $path = $this->basePath . $input->getArgument('path');
        
        if(!$this->fileSystem->exists($path)) {           
            try {    
                $this->fileSystem->mkdir($path);
            } catch (IOExceptionInterface $exception) {
                $io->error($exception->getMessage());
            }
        }
        return;
    }

    private function getStatusMessage($key)
    {
        $message = [
            'success' => 'Created Successfully',
            'error' => 'Could not create Controller',
            'exists' => 'Controller Already Exists'
        ];

        return $message[$key];
    }

}