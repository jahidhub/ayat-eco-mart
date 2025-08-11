<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class createViewFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:adminView {view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view File';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $viewname = $this->argument('view');
        $viewname =  $viewname . '.blade.php';
        $pathname = "resourse/views/{$viewname}";

        if (File::exists($pathname)) {
            $this->error("File {$pathname} is already exists");
            return;
        }

        $dir =  dirname($pathname);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $content = 'hello';

        File::put($pathname, $content);
        $this->info("File {$pathname} is Created");
    }
}
