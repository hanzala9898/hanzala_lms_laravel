@extends('master')
@section('view-students')

<div class="page-container">
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="title-5 m-b-35">Student List</h3>

                        <div class="table-responsive table--no-card m-b-30">
                            <div class="container mt-3">
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                            </div>

                            <table id="example" class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="text-end">Phone</th>
                                        <th class="text-end">Address</th>
                                        <th class="text-end">Parent Contact</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td class="text-end">{{ $student->phone }}</td>
                                        <td class="text-end">{{ $student->address }}</td>
                                        <td class="text-end">{{ $student->parent_contact }}</td>
                                        <td>{{ $student->date }}</td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="{{ route('students.edit', $student->id) }}">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Do you want to delete the record?')" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        {{-- Colspan 9 rakha hai kyunke table mein 9 columns hain --}}
                                        <td colspan="9" class="text-center">No Data Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
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