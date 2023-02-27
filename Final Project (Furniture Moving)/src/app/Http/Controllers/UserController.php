<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show_form=true;
        $users=User::orderBy('created_at','DESC')->paginate(5);
        return view('admin.pages.users',compact('users','show_form'));
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
    public function store(Request $data)
    {
        //
        if ($data->type == "add"){
        if ($data->image != null){
        $image = 'IMG'.'-'.time().'.'.$data->image->extension();
        $data->image->move(public_path('assets/images/users'),$image);
        }else{
            $image='user.png';
        }
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role'=>$data['role'],
            'password' => Hash::make($data['password']),
            'image'=>$image
        ]);
        return redirect()->route('admin.manage-users.index')->with('success','User Added Successfully');
    }
    if ($data->type == "search"){
        $show_form = false;
        $search_text = $data->search;
        $users=DB::table('users')
        ->select('*')
        ->orWhere('name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('email', 'LIKE', '%'.$search_text.'%')
        ->orWhere('phone', 'LIKE', '%'.$search_text.'%')
        ->orWhere('role', 'LIKE', '%'.$search_text.'%')
        ->paginate(5);
        return view('admin.pages.users',compact('users','show_form'));
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        User::where('id',$id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role'=>$data['role'],
        ]);
        return redirect()->route('admin.manage-users.index')->with('success','User Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.manage-users.index')->with('success','User Deleted Successfully');
    }
}
