@extends('layouts.app')
@section('content')
<form action="{{ route('import.users') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input class="form-control" type="file" name="file" accept=".xlsx, .csv">
    <button type="submit">Import Users</button>
</form>
@endsection
