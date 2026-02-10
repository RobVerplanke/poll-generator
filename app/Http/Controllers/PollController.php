<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function polls() {
        $polls = Poll::all();
        return view('welcome', compact('welcome'));
    }
}
