<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $owners=User::join('companies','companies.user_id','=','users.id')->orderBy('users.created_at','DESC')->paginate(10);
        return view('admin.pages.owners',compact('owners'));
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
        $search_text = $data->search;
        $owners=DB::table('users')
        ->select('*')
        ->join('companies','companies.user_id','=','users.id')
        ->orWhere('name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('email', 'LIKE', '%'.$search_text.'%')
        ->orWhere('phone', 'LIKE', '%'.$search_text.'%')
        ->orWhere('role', 'LIKE', '%'.$search_text.'%')
        ->orWhere('companies.company_name', 'LIKE', '%'.$search_text.'%')
        ->paginate(10);
        return view('admin.pages.owners',compact('owners'));
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
    public function update(Request $request, $id)
    {
        //
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
