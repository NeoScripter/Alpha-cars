<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\ManagerReview;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function show(Manager $manager, Request $request) {

        $manager->load([
            'managerReviews.user',
        ]);

        $userId = auth()->id();

        $existingReview = ManagerReview::select('id')->where('user_id', $userId)
            ->where('manager_id', $manager->id)
            ->first();

        $canComment = $existingReview ? false : true;

        $leaveReview = $request->query('review', false);

        return view('user.manager', compact('manager', 'canComment', 'leaveReview'));
    }
}
