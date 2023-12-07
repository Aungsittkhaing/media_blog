@extends('layouts.app')
@section('title')
    Article Details
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h4>Article Details</h4>
            <table class="table table-bordered">
                <tr class="text-center">
                    <td class="text-center">Title</td>
                    <td>{{ $article->title }}</td>
                </tr>
                <tr class="text-center">
                    <td class="text-center">Category</td>
                    <td>
                        <span class="badge bg-black">{{ $article->category_id }}</span>
                    </td>
                </tr>
                <tr class="text-center">
                    <td>Description</td>
                    <td>{{ $article->description }}</td>
                </tr>
                <tr>
                    <td>Created_At</td>
                    <td>{{ $article->created_at }}</td>
                </tr>
                <tr>
                    <td>Updated_At</td>
                    <td>{{ $article->updated_at }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
