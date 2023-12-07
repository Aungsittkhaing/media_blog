@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Create New Article</h3>
        <hr>
        <form action="{{ route('article.store') }}" method="post" class="mt-3 p-2">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Article Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="like news, political, economics, IT, etc" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Category</label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror"
                            placeholder="like news, political, economics, IT, etc" value="{{ old('category') }}">
                            @foreach (App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" cols="30" rows="10"
                            class="form-control @error('description') is-invalid @enderror">
                            </textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
