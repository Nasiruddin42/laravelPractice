@extends('layout')

@section('page-content')
<h1>BookStore</h1>
<div class="row">
    <div class="col-lg 12">
        <p class="text-right"><a class="btn btn-primary" href="{{ route('books.create') }}">New Book</a></p>
    </div>

</div>
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>TItle</th>
            <th>Author</th>
            <th>Price</th>
            <th colspan="3">Action</th>
        </tr>
        @foreach ($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->price }}</td>
            <td> <a href="{{ route('books.show', $book->id) }}" >View</a></td>
            <td> <a href="{{ route('books.edit', $book->id) }}" >Edit</a></td>
            <td>
                <form method="POST" action="{{ route('books.destroy') }}" onsubmit="return confirm('sure')" >
                    @csrf
                    <input type="hidden" name="id" value="{{ $book->id }}" >
                    <input type="submit" style="padding:0; margin:0 " value="delete" class="btn btn-link text-danger">

                </form>
            </td>
        </tr>
            
        @endforeach
    </table>
    {{ $books->links() }}
@endsection