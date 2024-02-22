<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Jobs\ProcessSubmission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function store(StoreSubmissionRequest $request)
    {
        $data = $request->validated();

        ProcessSubmission::dispatch(
            $data['name'],
            $data['email'],
            $data['message'],
        );
    }
}
