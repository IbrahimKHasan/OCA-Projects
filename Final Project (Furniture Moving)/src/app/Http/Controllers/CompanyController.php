<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show_form=true;
        switch (Auth::user()->role)
        {
            case 'admin':
                $companies=Company::paginate(2);
                return view('admin.pages.companies',compact('companies','show_form'));
                break;
            case 'owner':
                $companies=Company::where('user_id',Auth::user()->id)->paginate(2);
                return view('admin.pages.companies',compact('companies','show_form'));
                break;
            default:
                $companies=Company::all();
                return view('admin.pages.companies',compact('companies','show_form'));
                break;
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
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        //
        // dd($data);
        if ($data->type == "add"){
        $image = 'IMG'.'-'.time().'.'.$data->company_image->extension();
        $data->company_image->move(public_path('assets/images/companies'),$image);
        Company::create([
            'user_id'=>Auth::user()->id,
            'company_name'        => $data['company_name'],
            'company_email'       => $data['company_email'],
            'company_phone'       => $data['company_phone'],
            'company_description' => $data['company_description'],
            'company_location'    => $data['company_location'],
            'bedroom_price'       => $data['bedroom_price'],
            'livingroom_price'    => $data['livingroom_price'],
            'guestroom_price'     => $data['guestroom_price'],
            'kitchen_price'       => $data['kitchen_price'],
            'km_price'            => $data['km_price'],
            'pack_price'          => $data['pack_price'],
            'company_image'       => $image
        ]);
        return redirect()->route('admin.manage-companies.index')->with('success','Company Added Successfully');
    }
        if ($data->type == "search"){
        $show_form = false;
        $search_text = $data->search;
        $companies=DB::table('companies')
        ->select('*')
        ->orWhere('company_name', 'LIKE', '%'.$search_text.'%')
        ->orWhere('company_description', 'LIKE', '%'.$search_text.'%')
        ->orWhere('company_location', 'LIKE', '%'.$search_text.'%')
        ->orWhere('company_email', 'LIKE', '%'.$search_text.'%')
        ->orWhere('company_phone', 'LIKE', '%'.$search_text.'%')
        ->paginate(5);
        return view('admin.pages.companies',compact('companies','show_form'));
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data,$id)
    {
        if ($data->company_image == null){
            $image = Company::where('company_id',$id)->first()->company_image;
        }else{
        $image = 'IMG'.'-'.time().'.'.$data->company_image->extension();
        $data->company_image->move(public_path('images/companies'),$image);
        }
        Company::where('company_id',$id)->update([
            'company_name' => $data['company_name'],
            'company_description' => $data['company_description'],
            'company_location' => $data['company_location'],
            'bedroom_price' => $data['bedroom_price'],
            'livingroom_price' => $data['livingroom_price'],
            'guestroom_price' => $data['guestroom_price'],
            'kitchen_price' => $data['kitchen_price'],
            'km_price' => $data['km_price'],
            'status' => $data['status'],
            'pack_price' => $data['pack_price'],
            'company_image'=>$image
        ]);
        return redirect()->route('admin.manage-companies.index')->with('success','Company Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('company_id',$id)->delete();
        return redirect()->route('admin.manage-companies.index')->with('success','Company Deleted Successfully');
    }
}
