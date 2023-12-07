@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Create New Cateogory</h3>
        <hr>
        <form action="{{ route('category.store') }}" method="post" class="mt-3 p-2">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="like news, political, economics, IT, etc" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
