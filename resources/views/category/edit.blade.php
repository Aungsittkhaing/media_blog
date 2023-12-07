@extends('layouts.app')
@section('title')
    Edit Category
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('category.update', $category->id) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" value="{{ old('title', $category->title) }}" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="like news, political, economics, technology, etc">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-info">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
