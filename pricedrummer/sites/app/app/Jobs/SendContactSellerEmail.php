<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\ContactSeller;

class SendContactSellerEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_info;

	/**
	 * Create a new job instance.
	 *
	 */
    public function __construct( $user_info )
    {
        $this->user_info = $user_info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('admin@pricedrummer.com')
                ->later($this->queue_time, new ContactSeller( $user_info ));
    }
}
