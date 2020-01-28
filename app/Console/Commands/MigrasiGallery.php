<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cms\Gallery;
use App\Models\Cms\Galleryfile;

class MigrasiGallery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrasi:gallery';

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
        $gallery=\DB::connection('mysql2')
            ->table('t_gallery')
            ->whereNull('DELETED_AT')
            ->get();

        foreach($gallery as $row){
            $this->info('Gallery '.$row->title);

            $gl=new Gallery;
            $gl->id=$row->id;
            $gl->name = $row->title;
            $gl->no_urut= $row->sortir;
            $gl->author=1;
            $gl->created_at=$row->CREATED_AT;
            $gl->updated_at=$row->UPDATED_AT;
            $gl->save();
        }

        $this->info('update gallery detail');
        $detail=\DB::connection('mysql2')
            ->table('t_gallery_file')
            ->whereNull('DELETED_AT')
            ->get();

        foreach($detail as $row){
            $this->info('detail '.$row->idgallery);

            $gf=new Galleryfile;
            $gf->id=$row->id;
            $gf->gallery_id=$row->idgallery;
            
            if($row->typefile == "images"){
                $gf->file_type="image";
                $gf->file=$row->file;
            }else if($row->typefile == "video"){
                $gf->file_type=$row->typefile;
                $gf->video_url=$row->file;
            }

            $gf->title=$row->title;
            $gf->sortir=$row->sortir;
            $gf->author=1;
            $gf->created_at=$row->CREATED_AT;
            $gf->updated_at=$row->UPDATED_AT;
            $gf->save();
        }
    }
}
