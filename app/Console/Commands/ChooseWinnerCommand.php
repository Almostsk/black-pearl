<?php

namespace App\Console\Commands;

use App\Http\Services\Slack\Service\SlackService;
use App\Http\Services\StartMobile\Service\SmsService;
use App\Modules\User\Service\UserService;
use Illuminate\Console\Command;

class ChooseWinnerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'winner:identify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is being invoked every day in order to identify the code winner.
    It dispatches SMS on the winner`s mobile phone and sends to Slack notification about a winner';

    /** @var UserService */
    protected $userService;

    /** @var SmsService */
    protected $smsService;

    /** @var SlackService */
    protected $slackService;

    /**
     * Create a new command instance.
     *
     * @param UserService $userService
     * @param SmsService $smsService
     * @param SlackService $slackService
     * @return void
     */
    public function __construct(UserService $userService, SmsService $smsService, SlackService $slackService)
    {
        $this->userService = $userService;
        $this->smsService = $smsService;
        $this->slackService = $slackService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->userService->getCodesWinner();

        $this->smsService->sendMessage(config('response_message.congratulations_black_pearl'), $user->mobile_phone);
        $this->slackService->sendNotificationAboutWinner($user->id, $user->name, $user->surname);
    }
}
