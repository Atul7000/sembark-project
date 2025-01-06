
@extends('layouts.app')

@section('title', 'Invite New Client')

@section('content')

<h1>Invite New Client</h1>
<form method="POST" action="{{ url('/admin/invite') }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <!-- <input type="email" name="email" id="email" class="form-control" required> -->
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="client_name" class="form-label">Client Name</label>
        <input type="text" name="client_name" id="client_name" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Send Invite</button>
</form>
@endsection

