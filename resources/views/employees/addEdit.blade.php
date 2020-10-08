@section('title', isset($viewEmployees) ? 'Edit Emplyees' : 'Add Emplyees')
@extends('layouts.common')

@section('content')

    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Emplyees {{isset($viewEmployees) ? 'Edit' : 'Add'}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('employees')}}" title="Emplyees Management">Emplyees Management</a></li>
                                <li class="breadcrumb-item active">{{isset($viewEmployees) ? 'Edit' : 'Add'}}</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                <form method="POST"
                      action="{{ isset($viewEmployees) ? route('storeEmployees',$viewEmployees->id) : route('storeEmployees')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Employees</h3>
                                </div>
                                @if(isset($viewEmployees))
                                    <input type="hidden" id="id" name="id" value="{{$viewEmployees->id}}">
                                @endif
                                <input type="hidden" id="checkFormStatus"
                                       value="{{ isset($viewEmployees) ? 'edit' : 'insert'}}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">First Name<span class="required">*</span></label>
                                        <input type="text" name="first_name" id="first_name" class="form-control"
                                               value="{{ isset($viewEmployees) ? $viewEmployees->first_name : old('first_name') }}">
                                        <span class="error-msg">
                                          {{ $errors->first('first_name') }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name<span class="required">*</span></label>
                                        <input type="text" name="last_name" id="last_name" class="form-control"
                                               value="{{ isset($viewEmployees) ? $viewEmployees->last_name : old('last_name') }}">
                                        <span class="error-msg">
                                          {{ $errors->first('last_name') }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="companies_id">Company</label>
                                        <select class="form-control valid" style="width: 100%;" id="companies_id"
                                                name="companies_id">
                                            <option value="0">Select Company</option>
                                            @foreach($companyList as $company)
                                                @if(isset($viewEmployees))
                                                  <option value="{{$company->id}}" {{ isset($viewEmployees) ? ($company->id == $viewEmployees->companies_id ? 'selected' : '') : '' }}>{{$company->name}}</option>
                                                @else
                                                  <option value="{{$company->id}}" {{ $company->id == old('companies_id') ? 'selected' : '' }}>{{$company->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="error-msg">
                                          {{ $errors->first('companies_id') }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control"
                                               value="{{ isset($viewEmployees) ? $viewEmployees->email : old('email') }}" autocomplete="off">
                                        <span class="error-msg">
                                          {{ $errors->first('email') }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="number" name="phone" id="phone" class="form-control"
                                               value="{{ isset($viewEmployees) ? $viewEmployees->phone : old('phone') }}">
                                        <span class="error-msg">
                                          {{ $errors->first('phone') }}
                                        </span>
                                    </div>
                                   
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{route('employees')}}" class="btn btn-secondary">Cancel</a>
                            <input type="submit" value="{{isset($viewEmployees) ? 'Update' : 'Add'}}" class="btn btn-primary float-right">
                        </div>
                    </div>
                </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
