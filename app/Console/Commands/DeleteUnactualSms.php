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

    /** @var SmsService */
    private $smsService;

    /**
     * Create a new command instance.
     *
     * @param SmsService $smsService
     * @return void
     */
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log('123');
        return $this->smsService->removeUnactualSms();
    }
}
