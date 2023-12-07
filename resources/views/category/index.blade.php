@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Category Lists</h3>
        <hr>
        <div class="mb-3">
            <a href="{{ route('category.create') }}" class="btn btn-outline-dark">Create</a>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>
                        title
                        <div class="btn-group">
                            <a href="{{ route('category.index', ['title' => 'asc']) }}" class="btn btn-outline-dark">
                                <i class="bi bi-arrow-bar-up"></i>
                            </a>
                            <a href="{{ route('category.index', ['title' => 'desc']) }}" class="btn btn-outline-dark">
                                <i class="bi bi-arrow-bar-down"></i>
                            </a>
                            <a href="{{ route('category.index') }}" class="btn btn-outline-dark">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        </div>
                    </th>
                    <th>Owner</th>
                    <th>Control</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            {{ $category->title }}
                            <br>
                            <span class="text-black-50 small">
                                {{ \Illuminate\Support\Str::limit($category->description, 20, '...') }}
                            </span>
                        </td>
                        <td>{{ $category->user->name }}</td>
                        <td>
                            <div class="btn-group">
                                @can('update', $category)
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-outline-dark">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endcan
                                @can('delete', $category)
                                    <button form="categoryDeleteForm{{ $category->id }}" class="btn btn-sm btn-outline-dark"
                                        onclick="return confirm('Are you sure to delete?')">
                                        <i class="bi bi-trash2"></i>
                                    </button>
                                @endcan
                                <form id="categoryDeleteForm{{ $category->id }}"
                                    action="{{ route('category.destroy', $category->id) }}" class="d-inline-block"
                                    method="post">
                                    @method('delete')
                                    @csrf

                                </form>
                            </div>
                        </td>
                        <td>
                            <p>
                                <i class="bi bi-calculator"></i>
                                {{ $category->created_at->format('d M Y') }}
                            </p>
                            <p>
                                <i class="bi bi-clock"></i>
                                {{ $category->created_at->format('h:i a') }}
                            </p>
                        </td>
                        <td>
                            <p>
                                <i class="bi bi-calculator"></i>
                                {{ $category->updated_at->format('d M Y') }}
                            </p>
                            <p>
                                <i class="bi bi-clock"></i>
                                {{ $category->updated_at->format('h:i a') }}
                            </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            There is no record <br>
                            <a href="{{ route('category.create') }}" class="btn btn-outline-primary btn-sm">Create</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection
