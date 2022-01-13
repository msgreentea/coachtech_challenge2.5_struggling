<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChallengeRequest;
use App\Models\Contact;
use Illuminate\Pagination\Paginator;

class ChallengeController extends Controller
{
    // お問い合わせフォーム
    public function form(ChallengeRequest $request)
    {
        return view('form');
    }

    public function confirm(ChallengeRequest $request)
    // public function confirm(Request $request)
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
    // public function register(ChallengeRequest $request)
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
        return view('system');
    }

    public function find(Request $request)
    // public function find(Request $request)
    {
        $keyword = $request->all();
        // dd($keyword);
        $query = Contact::query();
        if ($keyword !== null) {
            $query->where('familyname', 'LIKE', "%{$keyword}%")
                ->orwhere('lastname', 'LIKE', "%{$keyword}%")
                ->orwhere('gender', 'LIKE', "%{$request->gender}%")
                ->orwhere('created_at', 'LIKE', "%{$request->created_at}%")
                ->orwhere('email', 'LIKE', "%{$request->email}%");
        }
        $pagination = $query->orderBy('created_at', 'desc')->paginate(10);

        // todoアプリ２の検索の方法
        // $keyword = Contact::where('fullname', 'LIKE', "%{$request->fullname}%")
        //     ->orwhere('gender', 'LIKE', "%{$request->gender}%")
        //     ->orwhere('created_at', 'LIKE', "%{$request->created_at}%")
        //     ->orwhere('email', 'LIKE', "%{$request->email}%")->get();

        // $pagination = Contact::paginate(10);

        // $fullname = $request->fullname;

        $items = [
            'keyword' => $keyword,
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'created_at' => $request->created_at,
            'email' => $request->email,
            'pagination' => $pagination
        ];

        return view('system', $items);
        // return view('test', $items);
    }

    public function delete(ChallengeRequest $request, $id)
    // public function delete(Request $request)
    {
        // Contact::find($request->id)->delete();
        $data = Contact::find($id);
        Contact::find($request->id)->delete();
        return redirect('/');
    }
}