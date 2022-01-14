<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChallengeRequest;
use App\Models\Contact;
use Illuminate\Pagination\Paginator;

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
        // $data = Contact::simplePaginate(10);
        // return view('system', $data);
        $items = Contact::all();
        return view('system', $items);
    }

    public function find(Request $request)
    {
        // AND検索
        $result = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
            ->where('gender', 'LIKE', "%{$request->gender}%")
            // ->where('created_at', 'LIKE', "%{$request->created_at}%")
            ->whereDate('created_at', 'LIKE', "%{$request->created_at}%")
            ->where('email', 'LIKE', "%{$request->email}%")->get();




        // $keyword = Contact::when($request->gender == 1) {
        //     $query->where('fullname', 'LIKE', "%{$request->fullname}%")
        //     ->orwhere('gender', 'LIKE', "%{$request->gender}%")
        //     ->orwhere('created_at', 'LIKE', "%{$request->created_at}%")
        //     ->orwhere('email', 'LIKE', "%{$request->email}%")->get();
        // }

        // $pagination = Contact::paginate(10);

        $items = [
            // 'query' => $query,
            // 'keyword' => $keyword,
            'result' => $result,
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'created_at' => $request->created_at,
            'email' => $request->email,
            // 'pagination' => $pagination
        ];
        // dd($items);
        return view('system', $items);
    }

    public function delete(Request $request, $id)
    // public function delete(Request $request)
    {
        // Contact::find($request->id)->delete();
        $data = Contact::find($id);
        Contact::find($request->id)->delete();
        return redirect('/');
    }
}