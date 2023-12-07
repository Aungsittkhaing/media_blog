@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Article Lists</h3>
        <hr>
        <div class="mb-3">
            <a href="{{ route('article.create') }}" class="btn btn-outline-dark">Create</a>
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
                            <a href="{{ route('article.index', ['title' => 'asc']) }}" class="btn btn-outline-dark">
                                <i class="bi bi-arrow-bar-up"></i>
                            </a>
                            <a href="{{ route('article.index', ['title' => 'desc']) }}" class="btn btn-outline-dark">
                                <i class="bi bi-arrow-bar-down"></i>
                            </a>
                            <a href="{{ route('article.index') }}" class="btn btn-outline-dark">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        </div>
                    </th>
                    <th>Category</th>
                    @can('admin-only')
                        <th>Owner</th>
                    @endcan
                    <th>Control</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>
                            {{ $article->title }}
                            <br>
                            <span class="text-black-50 small">
                                {{ \Illuminate\Support\Str::limit($article->description, 20, '...') }}
                            </span>
                        </td>
                        <td>
                            {{ $article->category->title ?? 'Unknown' }}
                        </td>
                        @can('admin-only')
                            <td>{{ $article->user->name }}</td>
                        @endcan
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('article.show', $article->id) }}" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-list-check"></i>
                                </a>
                                @can('update', $article)
                                    <a href="{{ route('article.edit', $article->id) }}" class="btn btn-sm btn-outline-dark">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endcan
                                @can('delete', $article)
                                    <button form="articleDeleteForm{{ $article->id }}" class="btn btn-sm btn-outline-dark"
                                        onclick="return confirm('Are you sure to delete?')">
                                        <i class="bi bi-trash2"></i>
                                    </button>
                                @endcan
                                <form id="articleDeleteForm{{ $article->id }}"
                                    action="{{ route('article.destroy', $article->id) }}" class="d-inline-block"
                                    method="post">
                                    @method('delete')
                                    @csrf

                                </form>
                            </div>
                        </td>
                        <td>
                            <p>
                                <i class="bi bi-calculator"></i>
                                {{ $article->created_at->format('d M Y') }}
                            </p>
                            <p>
                                <i class="bi bi-clock"></i>
                                {{ $article->created_at->format('h:i a') }}
                            </p>
                        </td>
                        <td>
                            <p>
                                <i class="bi bi-calculator"></i>
                                {{ $article->updated_at->format('d M Y') }}
                            </p>
                            <p>
                                <i class="bi bi-clock"></i>
                                {{ $article->updated_at->format('h:i a') }}
                            </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            There is no record <br>
                            <a href="{{ route('article.create') }}" class="btn btn-outline-primary btn-sm">Create</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $articles->onEachSide(1)->links() }}
    </div>
@endsection
