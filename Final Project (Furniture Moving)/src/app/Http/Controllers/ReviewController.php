<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Company;
use Illuminate\Support\Facades\DB;


class ReviewController extends Controller
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
        $reviews = DB::table('reviews')
        ->select('*')
        ->join('companies','companies.company_id','=','reviews.company_id')
        ->join('users','users.id','=','reviews.user_id')
        ->orderBy('reviews.created_at','DESC')
        ->paginate(10);
        return view('admin.pages.reviews',compact('reviews'));
        }else{
            $company = Company::where('user_id',Auth::user()->id)->first();
            if ($company!=null){
                $id = $company->company_id;
            $reviews = DB::table('reviews')
            ->select('*')
            ->join('companies','companies.company_id','=','reviews.company_id')
            ->join('users','users.id','=','reviews.user_id')
            ->where('reviews.company_id',$id)
            ->orderBy('reviews.created_at','DESC')
            ->paginate(10);
            }
            if ($company==null){
                $reviews=[];
            }
            return view('admin.pages.reviews',compact('reviews'));
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
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        if ($data['type']=="search"){
        $search_text = $data->search;
        $reviews=DB::table('reviews')
        ->select('*')
        ->join('companies','companies.company_id','=','reviews.company_id')
        ->join('users','users.id','=','reviews.user_id')
        ->orWhere('users.name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('companies.company_name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('review_body', 'LIKE', '%'.$search_text.'%')
        ->paginate(10);
        return view('admin.pages.reviews',compact('reviews'));
        }else{
        Review::create([
            'user_id'=>Auth::user()->id,
            'company_id'=>$data['company_id'],
            'review_rate'=>$data['rate'],
            'review_body'=>$data['review_body']
        ]);
        $rate = Review::where('company_id',$data['company_id'])->avg('review_rate');
        $count = Review::where('company_id',$data['company_id'])->count();
        Company::where('company_id',$data['company_id'])->update([
                'company_rate'=>round($rate,1),
                'company_rate_count'=>$count,
            ]);
        Alert::success('Review Sent Successfully');
        return redirect()->route('company.show',$data['company_id'])->with('success','Review Sent Successfully');
        $company_id = $data['company_id'];
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
