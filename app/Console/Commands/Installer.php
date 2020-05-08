<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Installer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:shop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Shop Application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm('Do you sure to continue install shop? [yes|no]')) {
            $this->info("Runing proces for check updates on packeges");
            exec('composer update');
            $this->line("All it's update. next steep");
            $this->info('Runing best performance for configuration');
            $this->call('config:clear', []);
            $this->line("Config has been cleared, next steep");
            Artisan::queue('view:clear');
            $this->info('All templates has been cleared for cache');
            $this->line("View has been cleared, next steep");
            Artisan::queue('key:generate');
            $this->info('Your application key has been set.');
            $this->line("Register application key, next steep");
            Artisan::queue('storage:link');
            $this->info('The storage link has been created on /public folder');
            $this->info("Create database tables and seeders");
            Artisan::queue("migrate:refresh --seed");
            $this->info('All database tables has been created, all products and categories has been created.');
            $this->line("");
            $this->line("");
            $this->info('Thanks for installing EF Shop, your application is new ready for use.');
            $this->info('For more information visit: www.procms.ro/efgroup');
        }
    }
}
