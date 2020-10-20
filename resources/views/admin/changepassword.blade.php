@extends('layouts.admin')

@section('page-title', 'Change Password')
@section('module', 'Change Password')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success ! {{ session('success') }}</strong> .
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Change Password</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.password.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="password">Current Password</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password" placeholder="Enter Current password">
                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}" name="new_password" id="new_password" placeholder="Enter new password">
                        <div class="invalid-feedback">{{ $errors->first('new_password') }}</div>
                    </div>

                    <div class="form-group">
                        <label for="renew_password">Re Enter New Password</label>
                        <input type="password" class="form-control {{ $errors->has('renew_password') ? 'is-invalid' : '' }}" name="renew_password" id="renew_password" placeholder="Re enter new password">
                        <div class="invalid-feedback">{{ $errors->first('renew_password') }}</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@stop
