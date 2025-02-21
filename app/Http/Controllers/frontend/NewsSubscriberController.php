<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\NewsSubscriber;
use App\Http\Controllers\Controller;
use App\Mail\Frontend\NewSubscriberMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class NewsSubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:news_subscribers,email',
        ]);
        $newsSubscriber = NewsSubscriber::create([
            'email' => $request->email
        ]);

        if (!$newsSubscriber) {
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }
        Mail::to($request->email)->send(new NewSubscriberMail());
        Session::flash('success', 'You have successfully subscribed to our newsletter!');
        return redirect()->back();
    }
}
