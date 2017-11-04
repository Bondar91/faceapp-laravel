<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

class SearchController extends Controller
{
    public function users()
    {
        $search_phrase = Input::get('q');
        $search_results_users = User::where('name', 'like', '%' . $search_phrase . '%')->paginate(3);

        return view('search.users', compact('search_results_users','search_phrase'));
    }
}
