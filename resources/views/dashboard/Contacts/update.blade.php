@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            
            <div class="card">

                <div class="card-body p-4">
                    
                    <div class="text-center mb-4">
                        <h4 class="text-uppercase mt-0">Register</h4>
                    </div>

                    <form action="{{route('contact.update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input value="{{ old('name',Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" type="text" id="name" placeholder="Enter your name" required="" name="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input value="{{ old('email',Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" name="email" type="email" id="email" required="" placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" value="{{ old('phone',Auth::user()->phone) }}" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" id="location" value="{{ old('location',Auth::user()->location) }}" name="location" class="form-control @error('location') is-invalid @enderror" placeholder="Enter location">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" value="{{ old('image') }}" id="image" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Select image">
                            <img src="{{asset('assets/images/users/'. Auth::user()->image) }}" class="img-fluid py-2" width="100px" height="100px">

                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">User Profile Info</label>
                            <textarea class="form-control @error('profile') is-invalid @enderror" name="profile" id="profile" rows="5">{{ old('profile',Auth::user()->profile) }}</textarea>
                            @error('profile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="mb-3 text-center d-grid">
                            <button class="btn btn-primary" type="submit"> Send Request </button>
                        </div>

                    </form>

                </div> <!-- end card-body -->
            </div>
            <!-- end card -->

            
            <!-- end row -->

        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection