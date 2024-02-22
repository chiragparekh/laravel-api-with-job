<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSubmissionListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     */
    public function handle(SubmissionSaved $event): void
    {
        $submission = Submission::find($event->submissionId);

        if(! $submission) {
            Log::error('No submission found to log');
        }

        Log::info(json_encode($submission));
    }
}
