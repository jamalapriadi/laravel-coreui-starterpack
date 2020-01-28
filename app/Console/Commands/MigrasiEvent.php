<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cms\Post;

class MigrasiEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrasi:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $event=\DB::connection('mysql2')
            ->table('t_event')
            ->whereNull('DELETED_AT')
            ->get();

        foreach($event as $row){
            $this->info('event '. $row->title);

            $post=new Post;
            $post->title=$row->title;
            $post->featured_image=$row->images;
            $post->description=$row->description;
            $post->lokasi=$row->location;
            // $post->tanggal=$row->date_event;
            // $post->jam_mulai=$row->time_event;
            $post->author=1;
            $post->created_at=$row->CREATED_AT;
            $post->updated_at=$row->UPDATED_AT;
            $post->post_type='event';
            $post->post_status='publish';
            $post->save();

        }

        $this->info('migrasi event selesai');
    }
}
