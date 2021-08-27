@extends('template.index')
@section('content')
    <form class="mx-auto" action="/album/{{ $album->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="text" value="{{ $album->name }}" name="name" placeholder="Name" id="">
        <input type="text" value="{{ $album->author }}" name="author" placeholder="Auteur" id="">
        <input type="file" name="img_src" id="">
        <input type="submit" value="Save" class="btn btn-primary text-white">
    </form>
@endsection
