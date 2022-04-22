@extends('layouts.app-master')

@section('content')
<link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Lead profile
                </h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{!empty($data['editLead'])?$data['editLead']->name:''}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{!empty($data['editLead'])?$data['editLead']->email:''}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{!empty($data['editLead'])?$data['editLead']->phone:''}}</td>
                        </tr>
                        <tr>
                            <td>
                                Address
                            </td>
                            <td>{{!empty($data['editLead'])?$data['editLead']->address:''}}</td>
                        </tr>
                        <tr>
                            <td>Note</td>
                            <td>{{!empty($data['editLead'])?$data['editLead']->notes:''}}</td>
                        </tr>
                        <tr>
                            <td>Created at</td>
                            <td><?php echo date('Y-m-d', strtotime($data['editLead']->created_at)); ?></td>
                        </tr>
                        <tr>
                            <td>Created by</td>
                            <td>{{ $data['editLead']->user_name }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <?php if (!empty($data['editLead'])) { ?>
                                    <img style="width: 100px;height: 100px;" src="{{asset('images/uploads/leads/')}}/<?php echo $data['editLead']->image; ?>" alt="lead" />
                            </td>
                        <?php } ?>
                        </tr>
                    </tbody>
            </div>
        </div>
    </div>
</div>
@endsection