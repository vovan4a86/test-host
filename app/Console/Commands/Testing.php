<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Testing extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Testing';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
//        $test = 'Квантовая физика и сознание человека / Антропный принцип участия.mp3';
//        $new_filename = preg_replace("/[^. a-zа-яё\d]/ui", "", $test);
//        $this->info($new_filename);
//        exit();


        $name = null;
        $file = null;
        $thumb = null;
        $files = scandir(public_path('/output'));
        foreach ($files as $file_name) {
            if ($file_name != '.' || $file_name != '..') {
                if (preg_match('/\.(mp3)/', $file_name)) {
                    $new_filename = preg_replace("/[^. a-zа-яё\d]/ui", "", $file_name);
                    rename(public_path('/output/') . $file_name, public_path('/output/') . $new_filename);
                    $file = '/output/' . $new_filename;
                    $name = preg_replace('/\.(mp3)/', '', $new_filename);
                }
                if (preg_match('/\.(jpg|jpeg|webp|png)/', $file_name)) {
                    $new_filename = preg_replace("/[^. a-zа-яё\d]/ui", "", $file_name);
                    rename(public_path('/output/') . $file_name, public_path('/output/') . $new_filename);
                    $dot_index = mb_strrpos($new_filename, '.');
                    $ext = substr($new_filename, $dot_index);
                    $thumb = '/output/' . $name . $ext;
                }
            }
        }
        $this->info('name: ' . $name);
        $this->info('file: ' . $file);
        $this->info('thumb: ' . $thumb);
        $this->info('ext: ' . $ext);
        $w = $ext == '.webp' ? 'webp' : false;
        $this->info('webp? ' .  $w);
    }
}
