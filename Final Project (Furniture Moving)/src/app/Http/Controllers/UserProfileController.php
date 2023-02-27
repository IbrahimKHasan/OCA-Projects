<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('company_users')
        ->select('*', 'company_users.status as booking_status')
        ->join('companies','companies.company_id','=','company_users.company_id')
        ->where('company_users.user_id',Auth::user()->id)
        ->orderBy('company_users.date','DESC')
        ->get();
        $reviews = DB::table('reviews')
        ->select('*')
        ->join('companies','companies.company_id','=','reviews.company_id')
        ->where('reviews.user_id',Auth::user()->id)
        ->orderBy('reviews.created_at','DESC')
        ->get();
        $count = DB::table('company_users')->where('company_users.user_id',Auth::user()->id)->count();
        $price = DB::table('company_users')->where('company_users.user_id',Auth::user()->id)->sum('price');
        return view('public.pages.user',compact('user','count','price','reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companies=User::all();
        return view('public.pages.landing',compact('companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
        if ($data->image == null){
            $image = User::where('id',$id)->first()->image;
        }else{
        $image = 'IMG'.'-'.time().'.'.$data->image->extension();
        $data->image->move(public_path('assets/images/users'),$image);
        }
        User::where('id',$id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password'=>Hash::make($data['password']),
            'image'=>$image,
        ]);
        return redirect()->route('user.index')->with('success','User Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
