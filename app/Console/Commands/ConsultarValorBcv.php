<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\OperacionesBCV;

class ConsultarValorBcv extends Command
{
    use OperacionesBCV;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consultar:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $operacion = $this->consultarelvalordelusd();

        if ($operacion == false) {           
            return Command::SUCCESS;
        } else {
            return Command::SUCCESS; 
        }        
        
        //return Command::SUCCESS;
    }
}
