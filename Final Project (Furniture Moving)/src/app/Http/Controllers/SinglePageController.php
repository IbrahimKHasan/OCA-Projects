<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SinglePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
        $bedroom_price = $data['bedroom_no'] * $data['bedroom_price'];
        $livingroom_price = $data['livingroom_no'] * $data['livingroom_price'];
        $guestroom_price = $data['guestroom_no'] * $data['guestroom_price'];
        $kitchen_price = $data['kitchen_no'] * $data['kitchen_price'];
        $km_price = $data['km_no'] * $data['km_price'];
        $not_available_time = DB::table('company_users')->where('company_id',$data['company_id'])->select('date')->get();
        $not_available_time_count = DB::table('company_users')->where('company_id',$data['company_id'])->count();
        foreach ($not_available_time as $value) {
            if ($value->date ==$data['date']){
                $date_check = false;
                Alert::error("This Date is booked");
                return redirect()->route('company.show',$data['company_id']);
            }else{
                $date_check = true;
            }
        }
        if ($not_available_time_count==0){
            $date_check = true;
        }
        if ($data['packing']=="yes"){
            $pack_price = $data['pack_price'];
        } else {
            $pack_price = 0;
        }
        $price = $bedroom_price + $livingroom_price + $guestroom_price + $kitchen_price + $km_price + $pack_price;
        if ($date_check){
        DB::table('company_users')->insert([
            'user_id'=>Auth::user()->id,
            'company_id'=>$data['company_id'],
            'user_email'=>Auth::user()->email,
            'phone'=>$data['phone'],
            'price'=>$price,
            'date'=>$data['date']
        ]);
        Company::where('company_id',$data['company_id'])->update([
            'company_bookings_count'=>DB::table('company_users')->where('company_id',$data['company_id'])->count()
        ]);
        Alert::success('Booked Successfully', "You are booked successfully, the price is: $price JD");
        return redirect()->route('company.show',$data['company_id'])->with('success','Booked Successfully');
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
        $not_available_time = DB::table('company_users')->where('company_id',$id)->select('date')->get();
        foreach ($not_available_time as $value) {
            if ($value->date ==date("Y-m-d")){
                Company::where('company_id',$id)->update([
                    'status'=>'Not Available',
                ]);
                DB::table('company_users')->where('company_id',$id)->update([
                    'status'=>'in progress'
                ]);
            }
        }
        $reviews = Review::where('company_id',$id)
        ->join('users','users.id','=','reviews.user_id')
        ->orderBy('reviews.created_at','desc')
        ->get();
        $rate = Review::where('company_id',$id)->avg('review_rate');
        $count = Review::where('company_id',$id)->count();
        $company=Company::where('company_id',$id)->first();
        if (Auth::user()!=null){
        $user = Review::where('user_id',Auth::user()->id)->where('company_id',$id)->count();
        $booking = DB::table('company_users')
        ->where('company_id',$id)
        ->where('user_id',Auth::user()->id)->count();
        // dd($booking);
        if ($booking > 0){
        if ($user>=1){
            $check = 'no';
        }else{
            $check = 'yes';
        }
    }else{
        $check = 'no booking';
    }
        if ($booking > 0){
            $booking_check = true;
        }else{
            $booking_check = false;
        }
    }
    if (Auth::user()==null){
        $check = 'guest';
    }
        return view('public.pages.singlepage',compact('company','not_available_time','reviews','rate','count','check'));
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
