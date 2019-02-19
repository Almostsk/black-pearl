<?php

namespace App\Console\Commands;

use App\Modules\Sms\Service\SmsService;
use Illuminate\Console\Command;

class DeleteUnactualSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removing unactual sms';

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
     * @param SmsService $smsService
     */
    public function handle(SmsService $smsService)
    {
        $smsService->removeUnactualSms();
    }
}
