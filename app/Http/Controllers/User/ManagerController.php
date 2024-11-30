<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function show(Manager $manager) {

        $manager->load([
            'managerReviews.user',
        ]);
        return view('user.manager', compact('manager'));
    }
}
