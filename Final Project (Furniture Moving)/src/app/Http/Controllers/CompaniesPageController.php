<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CompaniesPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Update Booking count after sseeder and faker
        // $companies2 = Company::all();
        // foreach ($companies2 as $company) {
        //     $id = $company->company_id;
        //     $count = DB::table('company_users')->where('company_id',$id)->count();
        //     Company::where('company_id',$id)->update([
        //         'company_bookings_count'=>$count
        //     ]);
        // }
        //----------------------------------------------------------
         //Update Rate and rate count after sseeder and faker
        // $companies2 = Company::all();
        // foreach ($companies2 as $company) {
        //     $id = $company->company_id;
        //     $rate = DB::table('reviews')->where('company_id',$id)->avg('review_rate') != null ? DB::table('reviews')->where('company_id',$id)->avg('review_rate'): 0 ;
        //     Company::where('company_id',$id)->update([
        //         'company_rate'=>$rate
        //     ]);
        // }
        //----------------------------------------------------------
         //Update Rate Count after sseeder and faker
        // $companies2 = Company::all();
        // foreach ($companies2 as $company) {
        //     $id = $company->company_id;
        //     $count = DB::table('reviews')->where('company_id',$id)->avg('review_rate') != null ? DB::table('reviews')->where('company_id',$id)->count(): 0 ;
        //     Company::where('company_id',$id)->update([
        //         'company_rate_count'=>$count
        //     ]);
        // }
        $companies=Company::paginate(10);
        return view('public.pages.companies',compact('companies'));
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
        if ($request->type=="search"){
        $search_text = $request->search;
        $companies=DB::table('companies')
        ->select('*')
        ->orWhere('company_name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('company_description', 'LIKE', '%'.$search_text.'%')
        ->orWhere('company_location', 'LIKE', '%'.$search_text.'%')
        ->paginate(10);
        return view('public.pages.companies',compact('companies'));
        }else{
            if ($request->filter == "high"){
            $companies=Company::where('status','Available')
            ->orderBy('company_rate','DESC')
            ->paginate(10);
            return view('public.pages.companies',compact('companies'));
            }
            else if ($request->filter == "low"){
                $companies=Company::where('status','Available')
                ->orderBy('company_rate','ASC')
                ->paginate(10);
                return view('public.pages.companies',compact('companies'));
            }
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
