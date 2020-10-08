<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Storage;
use App\Models\Employees;
use App\Models\Companies;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewEmployees = Employees::with('company')->paginate(10);
        $columns = [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'companies_id' => 'Company',
            'email' => 'Email',
            'phone' => 'Phone',
            'action' => 'Action'
        ];

        return view('Employees/index')->with(
        [
            'viewEmployees' => $viewEmployees,
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
        $companyList = Companies::get();
        return view('employees/addEdit')->with(['companyList' => $companyList]);
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
            $Employees = Employees::where('id', '=', $request->id)->first();
            $msg = "Employees updated successfully.";
        } else {
            $Employees = new Employees;
            $msg = "Employees added successfully.";
        }
        $Employees->id = $request->id;
        $Employees->first_name = $request->first_name;
        $Employees->last_name = $request->last_name;
        $Employees->companies_id = $request->companies_id;
        $Employees->email = $request->email;
        $Employees->phone = $request->phone;

        $Employees->save();
        return redirect()->route('employees')->with('msg', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $viewemploye = Employees::find($id);
        return view('Employees/view')->with(['viewemploye' => $viewemploye]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companyList = Companies::get();
        $viewemploye = Employees::find($id);
        return view('Employees/addEdit')->with(['viewEmployees' => $viewemploye,'companyList' => $companyList]);
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
        $deleteemploye = Employees::find($id)->delete();
        return redirect()->route('employees')->with('msg', "employe deleted successfully.");
    }

    //Form validation for Employees
    public function validateForm(Request $request)
    {
        $messages = [
            "first_name.required" => "Please enter first name",
            "first_name.max" => "The first name entered exceeds the maximum length ",
            "last_name.required" => "Please enter last name",
            "last_name.max" => "The last name entered exceeds the maximum length ",
            "email.email" => "Please enter valid email address",
            "phone.digits" => "Mobile No. must be in 10 digits",
            "phone.numeric" => "Please enter valid mobile No.",
        ];

        $validateAtt = $request->validate([
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'email' => 'nullable|email|regex:^\w+@[a-zA-Z_]+?\.[a-zA-Z.]{2,20}$^',
            'phone' => 'nullable|numeric|digits:10',
        ],$messages);

        return $validateAtt;
    }
}
