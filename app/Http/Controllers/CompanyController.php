<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $companies = Company::latest()->paginate(5);
  
        return view('company.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'website' => 'required',
        ]);
        if ($request->file('logo')) {
          $imagePath = $request->file('logo');
          $imageName = $imagePath->getClientOriginalName();
          $path = $request->file('logo')->storeAs('logo', $imageName, 'public');
        }
        $company = new Company;
        $company->name=$request->name;
        $company->email=$request->email;
        $company->logo = $imageName;
        $company->website=$request->website;
        $company->save();

        return redirect()->route('company.index')
                        ->with('success','company created successfully.');
    
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
        $company=Company::find($id);
        return view('company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'website' => 'required',
        ]);
        $input = $request->all();
        if ($request->file('logo')) {
          $imagePath = $request->file('logo');
          $imageName = $imagePath->getClientOriginalName();
          $path = $request->file('logo')->storeAs('logo', $imageName, 'public');
          $input['logo']=$imageName;
        }
         $company->update($input);
  
        return redirect()->route('company.index')
                        ->with('success','company updated successfully');
   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
      $company->delete();
  
        return redirect()->route('company.index')
                        ->with('success','company deleted successfully');
    
    }
}
