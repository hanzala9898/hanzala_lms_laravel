@extends('master')
@section('edit-student')

<!-- MAIN CONTENT-->
<div class="page-container">
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Edit</strong>
                                <small>Student</small>
                            </div>
                            <div class="card-body card-body">
                                
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Oops!</strong> Kuch masla hai:
                                    <ul>
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                <form action="{{ route('students.update', $students->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="company" class=" form-control-label">Name</label>
                                        <input type="text" id="company" value="{{ $students->name }}" name="name" placeholder="Enter your Name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="vat" class=" form-control-label">Email</label>
                                        <input type="email" id="email" value="{{ $students->email }}" name="email" placeholder="Email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="street" class=" form-control-label">Phone</label>
                                        <input type="text" id="phone" value="{{ $students->phone }}" name="phone" placeholder="+92123456789" class="form-control">
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-control-label">Address</label>
                                                <input type="text" value="{{ $students->address }}" id="address" name="address" placeholder="Enter your Address" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="postal-code" class="form-control-label">Parent Contact</label>
                                                <input type="text" value="{{ $students->parent_contact }}" id="parent_contact" name="parent_contact" placeholder="+92123456789" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="country" class=" form-control-label">Date</label>
                                        <input type="date" value="{{ $students->date }}" id="date" name="date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-dark btn-sm" type="reset">Cancel</button>
                                        <button class="btn btn-success btn-sm" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2025 Colorlib. All rights reserved. Template by <a href="https://colorlib.com" rel="nofollow" target="_blank">Colorlib</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection