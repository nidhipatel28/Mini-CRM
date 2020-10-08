@section('title', 'View Company')
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
                            <h1>Company View</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('companies')}}" title="Company Management">Company Management</a></li>
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
                            <h3 class="card-title">Company Detail</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3" for="logo">Logo:</label>
                                @if (!empty($viewCompany->logo) && file_exists(public_path('storage/upload/companies/images/'.$viewCompany->logo)))
                                    <img class="img-thumbnail img-responsive" src="{{asset('storage/upload/companies/images')}}/{{$viewCompany->logo}}">
                                @else
                                    <img class="img-thumbnail img-responsive" src="{{url('img/no-image.png')}}">
                                @endif
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="inputName">Name:</label>
                                <label class="col-sm-9" for="inputName">{{ $viewCompany->name }}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="inputEmail">Email:</label>
                                <label class="col-sm-9" for="inputEmail">{{ $viewCompany->email ? $viewCompany->email : '-'}}</label>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="inputwebsite">Website:</label>
                                <label class="col-sm-9" for="inputwebsite">{{ $viewCompany->website ? $viewCompany->website : '-'}}</label>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('companies') }}" class="btn btn-secondary">Cancel</a>
                            <a href="{{ route('editCompanies',$viewCompany->id) }}" class="btn btn-primary float-right">Edit Company</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
