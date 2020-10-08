@section('title', 'Employees Management')
@extends('layouts.common')

@section('content')
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Employees Management</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            @if(session()->has('msg'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong>Success!</strong> {{ session()->get('msg') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="#" method="GET">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <a href="{{route('addViewEmploye')}}" class="btn btn-primary float-right"><i
                                                class="fas fa-plus"></i> Add Employe</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0 custom_table">
                                    @if ($viewEmployees->count() == 0)
                                        <div class="no-data">No Data Available</div>
                                    @else
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                @foreach($columns as $key => $column)
                                                    <th span class="column-name-color">{{$column}} </span> </th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($viewEmployees as $employe)
                                                <tr>
                                                    <td>{{ $employe->first_name }}</td>
                                                    <td>{{ $employe->last_name }}</td>
                                                    <td>{{ $employe->company ? $employe->company->name : '-' }}</td>
                                                    <td>{{ $employe->email ? $employe->email : '-'}}</td>
                                                    <td>{{ $employe->phone ? $employe->phone : '-' }}</td>
                                                    <td>
                                                        <div class="row icons">
                                                            <div class="col-md-3">
                                                                <a title="View Employe" href="{{ route('viewEmployees',$employe->id) }}"
                                                                   class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a title="Edit User" href="{{ route('editEmployees',$employe->id) }}"
                                                                   class="btn btn-primary"><i
                                                                        class="fas fa-edit"></i></a>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <form action="{{ route('deleteEmployees',$employe->id) }}"
                                                                      method="post">
                                                                    {{ csrf_field() }}
                                                                    <button title="Delete Employe" class="btn btn-danger" type="submit"
                                                                            onclick="return confirm('Are you sure you want to delete this Employe?')">
                                                                        <i class="fa fa-trash listdeleteicon"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                                @if ($viewEmployees->count() == 0)
                                    <div class="no-data"></div>
                                @else
                                    <div class="row pagination">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="dataTables_info">Showing {{ $viewEmployees->firstItem() }}
                                                to {{ $viewEmployees->lastItem() }} of {{ $viewEmployees->total() }}
                                                entries
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            {{$viewEmployees->links("pagination::bootstrap-4")}}
                                        </div>
                                    </div>
                                @endif
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        </div>
        <!-- Control Sidebar -->
    </div>
@endsection
