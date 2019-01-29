<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Member;
use App\Question;
use Carbon\Carbon;
use App\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_count = Item::count();
        $member_count = Member::where('created_at', Carbon::now()->format('Y-m-d'))->count();
        $question_count = Question::count();
        $conversations = Conversation::where('created_at', Carbon::now()->format('Y-m-d'))->paginate(10);

        return view('home', [
            'conversations' => $conversations,
            'item_count' => $item_count,
            'member_count' => $member_count,
            'question_count' => $question_count,
        ]);
    }
}
