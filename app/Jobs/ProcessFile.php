<?php

namespace App\Jobs;

use App\Helper\StreamingParser\StreamingParserFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class ProcessFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    public $file_type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $file_type)
    {
        $this->data = $data;
        $this->file_type = $file_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reader = new StreamingParserFactory();
        $stream = $reader->initialize($this->data, $this->file_type);
        $batch = Bus::batch([])->dispatch();
        $this->data = [];
        foreach ($stream->get() as $item) {
            if($item === 'stop'){
                $batch->add(new UploadFile($this->data));
                exit;
            }
            if(count($this->data) >  1000){
                $batch->add(new UploadFile($this->data));
                $this->data = [];
            }
            array_push($this->data,$item);
        }

    }
}
