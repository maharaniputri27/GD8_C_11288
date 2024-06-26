@extends('dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Movies</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Movies</a>
                        </li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('movie.create') }}" class="btn btn-md btn-success mb-3">TAMBAH MOVIE</a>
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Poster</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Director</th>
                                            <th class="text-center">Duration/min</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($movie as $item)
                                        <tr>
                                            <td class="text-center"><img src="/images/{{ $item->image }}" width="100px"></td>
                                            <td class="text-center">{{ $item->title }}</td>
                                            <td class="text-center">{{ $item->director }}</td>
                                            <td class="text-center">{{ $item->duration }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('movie.destroy', $item->id) }}" method="POST">
                                                    <a href="{{ route('movie.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <div class="alert alert-danger">
                                                    Data Movies belum tersedia
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $movie->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
