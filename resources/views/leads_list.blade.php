@extends('layouts.app-master')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Leads List</h4>
                                    <a href="{{ route('add') }}"><label class="badge badge-info">Add</label></a>

                                    @if(Session::has('message'))
                                        <div class="alert alert-success">
                                            <?php print_r(Session::get('message')); ?>
                                        </div>
                                    @endif


                                    <div class="table-responsive">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Created by</th>
                                                    <th>Created Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if (!empty($data) && $data->count())
                                                @foreach ($data as $key => $value)
                                                <tr>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td>{{ $value->phone }}</td>
                                                    <td>{{ $value->user_name }}
                                                    </td>
                                                    <td><?php echo date('Y-m-d', strtotime($value->created_at)); ?></td>
                                                    <td>
                                                        <a  href="{{ route('edit') }}/{{$value->id}}">
                                                            <label class="badge badge-warning">Edit</label>
                                                        </a>
                                                        <a  href="{{ route('view') }}/{{$value->id}}">
                                                            <label class="badge badge-info">View</label>
                                                        </a>
                                                        <a  href="{{ route('delete') }}/{{$value->id}}">
                                                        <label class="badge badge-danger">Delete</label>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10">There are no data.</td>
                                                </tr>
                                            @endif

                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection