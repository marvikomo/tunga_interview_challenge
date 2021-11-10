<?php

namespace App\Jobs;

use App\Libraries\DateLib;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UploadFile implements ShouldQueue, ShouldBeUnique
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $job_id = $this->job->getJobId();

        $last_key = $this->getLastKeyInserted($job_id);

        if(!$last_key || $last_key < 0){

               $this->uploadToDatabase($this->data,$job_id);
        }else{
            $this->uploadFromWhereStopedToDatabase($this->data, $last_key, $job_id);
        }


    }

    public function getLastKeyInserted($job_id){
        $last = DB::table('users')->where(['job_id'=>(int)$job_id])->orderBy('keys', 'desc')->first();
        if($last){
           return  $last->keys;
        }else{
            return false;
        }
    }
    public function uploadToDatabase($data, $job_id){
        foreach ($data as $key =>  $value){
            $value = (array) $value;
            $value['job_id'] = $job_id;
            $value['keys'] = $key;
            $credit_card = $value['credit_card'];
            //credit card data can be filtered before saving
            unset($value['credit_card']);
            $date = DateLib::covertToTimeString($value['date_of_birth']);
            $age = DateLib::getAge($date);
            if(DateLib::ageFilter($age)){
                $save_user = User::Create($value);
                $credit_cards = new CreditCard((array)$credit_card);
                $save_user->CreditCard()->save($credit_cards);
            }
        }
    }
    public function uploadFromWhereStopedToDatabase($data, $last_key, $job_id){
        foreach ($data as $key =>  $value){
            // echo $key;
            if((int)$key > $last_key ){

                $value = (array) $value;
                $value['job_id'] = $job_id;
                $value['keys'] = $key;
                $credit_card = $value['credit_card'];
                //credit card data can be filtered before saving
                unset($value['credit_card']);
                $date = DateLib::covertToTimeString($value['date_of_birth']);
                $age = DateLib::getAge($date);
                if(DateLib::ageFilter($age)){
                    $save_user = User::Create($value);
                    $credit_cards = new CreditCard((array)$credit_card);
                    $save_user->CreditCard()->save($credit_cards);
                }
            }
        }
    }
}
