<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\CompanyUser;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->role=="admin"){
            $users = DB::table('company_users')
            ->select('*','company_users.status as status')
            ->join('companies','companies.company_id','=','company_users.company_id')
            ->join('users','users.id','=','company_users.user_id')
            ->orderBy('company_users.date','ASC')
            ->paginate(10);
            return view('admin.pages.bookings',compact('users'));
            }else{
                $company = Company::where('user_id',Auth::user()->id)->first();
                if ($company!=null){
                    $id = $company->company_id;
                $users = DB::table('company_users')
                ->join('users','users.id','=','company_users.user_id')
                ->where('company_id',$id)
                ->distinct()
                ->orderBy('company_users.date','ASC')
                ->paginate(10);
                }
                if ($company==null){
                    $users=[];
                }
                return view('admin.pages.bookings',compact('users'));
            }
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
        $bookings=DB::table('company_users')
        ->select('*')
        ->join('companies','companies.company_id','=','company_users.company_id')
        ->join('users','users.id','=','company_users.user_id')
        ->orWhere('users.name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('companies.company_name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('user_email', 'LIKE', '%'.$search_text.'%')
        ->orWhere('status', 'LIKE', '%'.$search_text.'%')
        ->orWhere('phone', 'LIKE', '%'.$search_text.'%')
        ->orWhere('price', 'LIKE', '%'.$search_text.'%')
        ->paginate(10);
        return view('admin.pages.bookings',compact('bookings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyUser  $companyUser
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyUser $companyUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyUser  $companyUser
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyUser $companyUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyUser  $companyUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $company_id=$request->company_id;
        DB::table('company_users')->where('booking_id',$id)->update([
            'status'=>$request->status
        ]);

        if ($request->status == 'in progress'){
            DB::table('companies')->where('company_id',$company_id)->update([
                'status'=>'Not Available'
            ]);
        }else{
            DB::table('companies')->where('company_id',$company_id)->update([
                'status'=>'Available'
            ]);
        }
        return redirect()->route('admin.index')->with('success','Booking Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyUser  $companyUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyUser $companyUser)
    {
        //
    }
}
