<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::orderBy('created_at','DESC')
        ->paginate(10)
        ;
        return view('admin.pages.contacts',compact('contacts'));
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
        $search_text = $request->search;
        $contacts=DB::table('contacts')
        ->select('*')
        ->orWhere('contact_name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('contact_email', 'LIKE', '%'.$search_text.'%')
        ->orWhere('contact_phone', 'LIKE', '%'.$search_text.'%')
        ->orWhere('contact_message', 'LIKE', '%'.$search_text.'%')
        ->paginate(5);
        return view('admin.pages.contacts',compact('contacts'));
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
        Contact::where('id',$id)->delete();
        return redirect()->route('admin.manage-contacts.index')->with('success','Message Deleted Successfully');
    }
}
