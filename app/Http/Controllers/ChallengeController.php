<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChallengeRequest;
use App\Models\Contact;

class ChallengeController extends Controller
{
    // お問い合わせフォーム
    public function form()
    {
        return view('form');
    }

    public function confirm(ChallengeRequest $request)
    {

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

    public function register(Request $request)
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
        $results = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', 'LIKE', "%{$request->gender}%")
            ->whereDate('created_at', 'LIKE', "%{$request->created_at}%")
            ->where('email', 'LIKE', "%{$request->email}%")->get();

        $pagination = Contact::simplePaginate(10);

        $items = [
            'results' => $results,
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'created_at' => $request->created_at,
            'email' => $request->email,
            'pagination' => $pagination
        ];
        // dd($items);
        return view('system', $items);
    }

    public function delete(Request $request, $id)
    {
        $data = Contact::find($id);
        Contact::find($request->id)->delete();
        return redirect('system');
    }
}