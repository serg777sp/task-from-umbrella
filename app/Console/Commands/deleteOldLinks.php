<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Link;
use Carbon\Carbon;

class deleteOldLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'link:removeOld';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removing links older than 15 days';

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
        //
	foreach (Link::all() as $link){
	    if(Carbon::now() > Carbon::parse($link->created_at.' + 15 days')){
		$link->delete();
	    }
	}
    }
}
