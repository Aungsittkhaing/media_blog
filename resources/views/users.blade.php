@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Article Lists</h3>
        <hr>
        <div class="">
            <a href="{{ route('article.create') }}" class="btn btn-outline-dark">Create</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Information</th>
                    <th>Category Count</th>
                    <th>Article Count</th>
                    <th>Control</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            {{ $user->name }}
                            <br>
                            <span class="text-black-50 small">
                                {{ $user->email }}
                            </span>
                        </td>
                        <td>{{ $user->category->count() }}</td>
                        <td>{{ $user->article->count() }}</td>
                        <td>
                        </td>
                        <td>
                            <p>
                                <i class="bi bi-calculator"></i>
                                {{ $user->created_at->format('d M Y') }}
                            </p>
                            <p>
                                <i class="bi bi-clock"></i>
                                {{ $user->created_at->format('h:i a') }}
                            </p>
                        </td>
                        <td>
                            <p>
                                <i class="bi bi-calculator"></i>
                                {{ $user->updated_at->format('d M Y') }}
                            </p>
                            <p>
                                <i class="bi bi-clock"></i>
                                {{ $user->updated_at->format('h:i a') }}
                            </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            There is no record <br>
                            <a href="{{ route('user.create') }}" class="btn btn-outline-primary btn-sm">Create</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->onEachSide(1)->links() }}
    </div>
@endsection
