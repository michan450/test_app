<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    
    public function confirm(ContactRequest $request)
    {
        
        $tel = $request->tel1 . $request->tel2 . $request->tel3;

        // 
        $fullName = $request->last_name . ' ' . $request->first_name;

        $genderText = [1=>'男性',2=>'女性',3=>'その他'][$request->gender];
        $categoryText = [
            1=>'商品のお届けについて',
            2=>'商品の交換について',
            3=>'商品トラブル',
            4=>'ショップへのお問い合わせ',
            5=>'その他'
        ][$request->category];

        $contact = [
            'name' => $fullName,
            'gender' => $genderText,
            'gender_value' => $request->gender,
            'email' => $request->email,
            'tel' => $tel,
            'address' => $request->address,
            'building' => $request->building ?? '',
            'category' => $categoryText,
            'category_value' => $request->category,
            'content' => $request->message,
        ];

        return view('confirm', compact('contact'));
    }

    
    public function store(Request $request)
    {
        $contact = new Contact();

    $contact->name = $request->name;
    $contact->gender = $request->gender_value; 
    $contact->email = $request->email;
    $contact->tel = $request->tel;
    $contact->address = $request->address;
    $contact->building = $request->building;
    $contact->category = $request->category_value; 
    $contact->content = $request->content;

    $contact->save();

    return view('thanks');
}
}