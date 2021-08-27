@extends("template.index")
@section('content')
    <form class="mx-auto" action="/album" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Name" id="">
        <input type="text" name="author" placeholder="Auteur" id="">
        <input type="file" name="img_src" id="">
        <input type="submit" value="Save" class="btn btn-primary text-white">
    </form>
    <hr class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Auteur</th>
                <th scope="col">Image</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($albums as $album)
                @if ($album !== null)
                    <tr>
                        <th scope="row">{{ $album->id }}</th>
                        <td>{{ $album->name }}</td>
                        <td>{{ $album->author }}</td>
                        {{-- {{ dd($album->photo->img_src) }} --}}
                        <td><img width="200" src="{{ asset('storage/img/' . $album->photo->img_src) }}" alt=""></td>
                        <td>
                            <a href="/album/{{ $album->id }}/edit" class="btn btn-success text-white">EDIT</a>
                        </td>
                        <td>
                            <form action="/album/{{ $album->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="X" class="btn btn-danger text-white">
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

@endsection
