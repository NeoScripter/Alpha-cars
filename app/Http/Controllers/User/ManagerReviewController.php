<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\ManagerReview;
use Illuminate\Http\Request;

class ManagerReviewController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'overallStars' => 'required|numeric|min:1|max:5',
            'responseSpeedStars' => 'required|numeric|min:1|max:5',
            'priceStars' => 'required|numeric|min:1|max:5',
            'keepsWordStars' => 'required|numeric|min:1|max:5',
            'content' => 'required|string|max:255',
            'manager_id' => 'required|exists:managers,id',
        ]);


        $userId = auth()->id();

        $validated['user_id'] = $userId;
        $manager = Manager::find($validated['manager_id']);

        $existingReview = ManagerReview::select('id')->where('user_id', $userId)
            ->where('manager_id', $validated['manager_id'])
            ->first();

        if ($existingReview) {
            return redirect()->route('user.manager', $manager->id)->withErrors([
                'message' => 'Вы уже оставили отзыв для этого менеджера.',
            ]);
        }

        ManagerReview::create($validated);

        $managerReviews = ManagerReview::select('overallStars')->where('manager_id', $validated['manager_id'])->pluck('overallStars');

        $averageRating = round($managerReviews->average(), 1);

        $manager->update(['stars' => $averageRating]);

        return redirect()->route('user.manager', $manager->id)->with([
            'status' => 'success',
            'message' => 'Спасибо за оставленный отзыв!',
        ]);
    }
}
