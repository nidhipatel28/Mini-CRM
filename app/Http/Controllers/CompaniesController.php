<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Storage;
use App\Models\Companies;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $viewCompanies = Companies::paginate(10);
             
         $columns = [
             'logo' => 'Logo',
             'name' => 'Name',
             'email' => 'Email',
             'website' => 'Website',
             'action' => 'Action'
         ];
 
         return view('companies/index')->with(
             [
                 'viewCompanies' => $viewCompanies,
                 'columns' => $columns,
             ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies/addEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);
        if ($request->id) {
            $companies = Companies::where('id', '=', $request->id)->first();
            $msg = "Companies updated successfully.";
        } else {
            $companies = new Companies;
            $msg = "Companies added successfully.";
        }
        // $companies->id = $request->id;
        $companies->name = $request->name;
        $companies->email = $request->email;
        $companies->website = $request->website;

        if ($request->hasFile('logo')) {
            if ($companies->logo) {
                Storage::delete('public/upload/companies/images/' . $companies->logo);
            }
            $file = $request->file('logo');
            $name = explode('.', $file->getClientOriginalName())[0];
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = $name . time() . '.' . $extension;
            Storage::disk('local')->put('public/upload/companies/images/' . $fileName, file_get_contents($file->getRealPath()));
            $companies->logo = $fileName;
        }

        $companies->save();
        return redirect()->route('companies')->with('msg', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viewCompany = Companies::find($id);
        return view('companies/view')->with(['viewCompany' => $viewCompany]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $viewCompany = Companies::find($id);
        return view('companies/addEdit')->with(['viewCompanies' => $viewCompany]);
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
        $deleteCompany = Companies::find($id)->delete();
        return redirect()->route('companies')->with('msg', "Company deleted successfully.");
    }

    //Form validation for companies
    public function validateForm(Request $request)
    {
        $messages = [
            "name.required" => "Please enter company name",
            "name.max" => "The name entered exceeds the maximum length ",
            "email.email" => "Please enter valid email address",
            "logo.dimensions" => "Logo must be 1000*1000",
            "website.regex" => "Please enter valid website",
        ];

        $validateAtt = $request->validate([
            'name' => 'required|max:191',
            'email' => 'nullable|email|regex:^\w+@[a-zA-Z_]+?\.[a-zA-Z.]{2,20}$^',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|dimensions:max_width=1000,max_height=1000',
            'website' => ['nullable', 'regex:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/'],
        ],$messages);

        return $validateAtt;
    }
}
