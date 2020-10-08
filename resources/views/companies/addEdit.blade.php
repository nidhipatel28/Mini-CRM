@section('title', isset($viewCompanies) ? 'Edit Companies' : 'Add Companies')
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
                            <h1>Company {{isset($viewCompanies) ? 'Edit' : 'Add'}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('companies')}}" title="Company Management">Company Management</a></li>
                                <li class="breadcrumb-item active">{{isset($viewCompanies) ? 'Edit' : 'Add'}}</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                <form method="POST" enctype="multipart/form-data"
                      action="{{ isset($viewCompanies) ? route('storeCompanies',$viewCompanies->id) : route('storeCompanies')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Companies</h3>
                                </div>
                                @if(isset($viewCompanies))
                                    <input type="hidden" id="id" name="id" value="{{$viewCompanies->id}}">
                                @endif
                                <input type="hidden" id="checkFormStatus"
                                       value="{{ isset($viewCompanies) ? 'edit' : 'insert'}}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name<span class="required">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ isset($viewCompanies) ? $viewCompanies->name : old('name') }}">
                                        <span class="error-msg">
                                          {{ $errors->first('name') }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control"
                                               value="{{ isset($viewCompanies) ? $viewCompanies->email : old('email') }}" autocomplete="off">
                                        <span class="error-msg">
                                          {{ $errors->first('email') }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Logo</label>
                                        <input type="file" style="width: 100%;" id="logo" name="logo" accept="image/x-png,image/gif,image/jpeg">
                                        <span class="error-msg">
                                            {{ $errors->first('logo') }}
                                        </span>
                                        @if(isset($viewCompanies))
                                            @if (!empty($viewCompanies->logo) && file_exists(public_path('storage/upload/companies/images/'.$viewCompanies->logo)))
                                                <img class="img-thumbnail img-responsive" id="logo-tag" src="{{asset('storage/upload/companies/images')}}/{{$viewCompanies->logo}}">
                                            @else
                                                <img class="img-thumbnail img-responsive" id="logo-tag" src="{{url('images/no-image.png')}}">
                                            @endif
                                        @else
                                            <img class="img-thumbnail img-responsive" style="display: none;" id="logo-tag" src="{{url('images/no-image.png')}}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="textarea" name="website" id="website" class="form-control"
                                               value="{{ isset($viewCompanies) ? $viewCompanies->website : old('website') }}">
                                        <span class="error-msg">
                                          {{ $errors->first('website') }}
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
                            <a href="{{route('companies')}}" class="btn btn-secondary">Cancel</a>
                            <input type="submit" value="{{isset($viewCompanies) ? 'Update' : 'Add'}}" class="btn btn-primary float-right">
                        </div>
                    </div>
                </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
