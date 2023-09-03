@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Article Detail</h4>

                <table class=" table">
                    <tr>
                        <td>Title</td>
                        <td>{{ $blog->title }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $blog->description }}</td>
                    </tr>

                    <tr>
                        <td>Created At</td>
                        <td>{{ $blog->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Updated At</td>
                        <td>{{ $blog->updated_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
