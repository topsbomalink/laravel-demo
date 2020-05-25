<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Order;
use Log;

class SendOrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order=$order;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        throw new \Exception("I am throwing this exception", 1);
     try{
        throw new \Exception("I am throwing this exception", 1);
            //Redis::throttle('my-mailtrap')->allow(2)->every(1)->then(function(){
                $recipient = 'steven@example.com';
                Mail::to($recipient)->send(new OrderShipped($this->order));
                Log::info('Emailed order ' . $this->order->id);
                Log::info('Sent using redis...');
           // }, function(){
           // return $this->release(2);
           // });

        }catch(Exception $ex){
            Log::error('Error while sending ', $ex);
        }
        
    }
}
