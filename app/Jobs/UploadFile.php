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

class UploadFile implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
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
        $date_lib = new DateLib();
        foreach ($this->data as $key =>  $value){
            $credit_card = $value['credit_card'];
            //credit card data can be filtered before saving
            unset($value['credit_card']);
            $date = $date_lib->covertToTime($value['date_of_birth']);
            $age = $date_lib->getAge($date);
            if($age === 18 || $age === 65 || !$age ){
                $save_user = User::Create($value);
                $credit_cards = new CreditCard($credit_card);
                $save_user->CreditCard()->save($credit_cards);
            }

        }
    }
}
