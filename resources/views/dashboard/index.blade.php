@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center my-4">Welcome to Your Dashboard</h1>
            <p class="text-center">Here is an overview of your account and activities.</p>

            <div class="row text-center mt-4">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Short URLs</h5>
                            <p class="card-text">View and manage your short URLs.</p>
                            <a href="{{ url('/urls') }}" class="btn btn-primary">Manage URLs</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Team Members</h5>
                            <p class="card-text">Invite and manage your team members.</p>
                            <a href="{{ url('admin/invite') }}" class="btn btn-primary">Manage Team</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Clients</h5>
                            <p class="card-text">View and manage your clients.</p>
                            <a href="{{ url('admin/clients') }}" class="btn btn-primary">Clients</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
