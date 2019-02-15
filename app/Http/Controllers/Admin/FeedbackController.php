<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Http\Controllers\Controller;
use App\Modules\Feedback\Service\FeedbackService;

class FeedbackController extends Controller
{
    private $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function index()
    {
        return view('admin.feedbacks.index', [
            'feedbacks' => $this->feedbackService->all()
        ]);
    }

    public function feedbackActive()
    {
        return view('admin.feedbacks.index', [
            'feedbacks' => $this->feedbackService->getActiveFeedbacks()
        ]);
    }

    public function feedbackInActive()
    {
        return view('admin.feedbacks.index', [
            'feedbacks' => $this->feedbackService->getInactiveFeedbacks()
        ]);
    }

    public function show($id)
    {
        return view('admin.feedbacks.show', [
            'feedback' => $this->feedbackService->find($id)
        ]);
    }

    public function deactivate($id)
    {
        if ($this->feedbackService->deactivate($id)) {
            Session::flash('success', 'You have successfully viewed a feedback');
        }

        return redirect()->route('feedbacks.index');
    }
}
