@extends('layouts.app-master')

@section('content')
<link rel="stylesheet" href="{{ asset('vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    @if(empty($data['editLead']))
                    Add lead form
                    @else
                    Edit lead form
                    @endif
                </h4>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(Session::has('message'))
                <div class="alert alert-success">
                    <?php print_r(Session::get('message')); ?>
                </div>
                @endif


                <form method="POST" class="forms-sample" enctype="multipart/form-data" action="{{ route('leadStore') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" required placeholder="Username" name="name" value="{{!empty($data['editLead'])?$data['editLead']->name:''}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" required class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{!empty($data['editLead'])?$data['editLead']->email:''}}"">
                    </div>
                    <div class=" form-group">
                        <label for="exampleInputPassword1">Phone</label>
                        <input type="number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required class="form-control" id="phone" placeholder="Phone" name="phone" value="{{!empty($data['editLead'])?$data['editLead']->phone:''}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Address</label>
                        <input type="text" required class="form-control" id="address" placeholder="Address" name="address" value="{{!empty($data['editLead'])?$data['editLead']->address:''}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Note</label>
                        <textarea name="notes" required class="form-control" id="exampleTextarea1" rows="4"><?php
                            if (!empty($data['editLead'])) {
                                print_r($data['editLead']->notes);
                            }
                            ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Lead image</label>
                        <!-- <input type="file" name="image" class="file-upload-default"> -->
                        <input type="file"  class="orm-control-file item-img-cat" id="item-img-cat image" name="image">

                    </div>

                    <div class="form-group">

                    </div>
                    <div class="form-check form-check-flat form-check-primary">

                    </div>
                    <?php if (!empty($data['editLead'])) { ?>
                        <input type="hidden" class="form-control" id="lead_id" placeholder="" name="lead_id" value="{{$data['editLead']->id}}">
                    <?php } ?>

                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection