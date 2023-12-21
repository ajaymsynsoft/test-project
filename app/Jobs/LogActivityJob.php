<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LogActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $_user_id;
    protected $_action;
    protected $_timest;
    protected $_route;
    /**
     * Create a new job instance.
     */
    public function __construct($_user_id,$_action,$_timest,$_route)
    {
        //
        $this->_user_id=$_user_id;
        $this->_action=$_action;
        $this->_timest=$_timest;
        $this->_route=$_route;
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        DB::Table('activity_log')->insert([
            'user_id'=>$this->_user_id,
            'action'=>$this->_action,
            'timestamp'=>$this->_timest,
            'route'=>$this->_route,
        ]);
    }
}
