<?php

namespace App\Http\Controllers\frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\ContactRequest;
use Illuminate\Support\Facades\Session;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('frontend.contact-us');
    }

    public function store(ContactRequest $request)
    {
        // Validate the request data
        $request->validated();
        $request->merge([
            'ip_address' => $request->ip()
        ]);

        $contact =  Contact::create($request->except('_token'));
        if (!$contact) {
            Session::flash('error', 'Your message could not be sent. Please try again later.');
            return redirect()->back();
        }
        Session::flash('success', 'Your message has been sent successfully.');
        return redirect()->back();
        // Contact::create($request->all());
        // return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
