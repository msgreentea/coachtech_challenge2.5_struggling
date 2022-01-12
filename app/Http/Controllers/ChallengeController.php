<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ChallengeController extends Controller
{
    // お問い合わせフォーム
    public function index(Request $request)
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        $this->validate($request, Contact::$rules);

        $fullname = $request->familyname . " " . $request->lastname;
        $gender = $request->gender;
        $email = $request->email;
        $postcode = $request->postcode;
        $address = $request->address;
        $building_name = $request->building_name;
        $opinion = $request->opinion;

        $items = [
            'fullname' => $fullname,
            'gender' => $gender,
            'email' => $email,
            'postcode' => $postcode,
            'address' => $address,
            'building_name' => $building_name,
            'opinion' => $opinion
        ];

        return view('confirm', $items);
    }

    public function add(Request $request)
    {
        $data = $request->all();
        Contact::create($data);
        return view('thanks');
    }



    // システム管理
    public function system()
    {
        return view('system');
    }

    public function find(Request $request)
    {

        // dd($request);
        $form = Contact::where([
            'fullname', 'LIKE', "%{$request->fullname}%",
            'gender', 'LIKE', "%{$request->gender}%",
            'created_at', 'LIKE', "%{$request->created_at}%",
            'email', 'LIKE', "%{$request->email}%",
        ])->get();

        $items = [
            'form' => $form,
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'created_at' => $request->created_at,
            'email' => $request->email
        ];

        return view('system', $items);
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/');
    }
}