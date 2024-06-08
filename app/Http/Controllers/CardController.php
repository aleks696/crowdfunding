<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function create()
    {
        return view('card.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cc_name' => 'required|string|max:255',
            'cc_number' => 'required|string|max:16',
            'cc_expiration' => 'required|string|max:5',
            'cc_cvv' => 'required|string|max:3',
        ]);

        $user = Auth::user();
        $user->card_name = $request->input('cc_name');
        $user->card_number = $request->input('cc_number');
        $user->card_expiration = $request->input('cc_expiration');
        $user->card_cvv = $request->input('cc_cvv');
        $user->save();

        return redirect()->route('home')->with('success', 'Card added successfully!');
    }
}
