@section('title', 'View Employee')
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
                            <h1>Employee View</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('employees')}}" title="Employee Management">Employee Management</a></li>
                                <li class="breadcrumb-item active">View</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content view-detail">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Employee Detail</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3" for="inputName">First Name:</label>
                                <label class="col-sm-9" for="inputName">{{ $viewemploye->first_name }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="inputName">Last Name:</label>
                                <label class="col-sm-9" for="inputName">{{ $viewemploye->last_name }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="inputName">Company:</label>
                                <label class="col-sm-9" for="inputName">{{ $viewemploye->company ? $viewemploye->company->name : '-' }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="inputEmail">Email:</label>
                                <label class="col-sm-9" for="inputEmail">{{ $viewemploye->email ? $viewemploye->email : '-'}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="inputphone">Phone:</label>
                                <label class="col-sm-9" for="inputphone">{{ $viewemploye->phone ? $viewemploye->phone : '-'}}</label>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('employees') }}" class="btn btn-secondary">Cancel</a>
                            <a href="{{ route('editEmployees',$viewemploye->id) }}" class="btn btn-primary float-right">Edit Employee</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
