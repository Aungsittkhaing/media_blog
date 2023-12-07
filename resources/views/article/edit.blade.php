@extends('layouts.app')
@section('title')
    Edit Article
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('article.update', $article->id) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Article Name</label>
                                <input type="text" value="{{ old('title', $article->title) }}" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="like news, political, economics, technology, etc">
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
                                            {{ old('category', $article->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" cols="30" rows="10" placeholder="Enter Description"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $article->description) }}
                                </textarea>
                                @error('description')
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
