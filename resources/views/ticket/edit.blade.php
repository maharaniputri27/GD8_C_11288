@extends('dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Movie</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Movie</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <form action="{{ route('ticket.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Class</label>
                                            <input type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class', $ticket->class) }}">
                                            @error('class')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Price</label>
                                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $ticket->price) }}">
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Movie Title</label>
                                    <select name="id_movie" id="id_movie" class="form-control @error('id_movie') is-invalid @enderror">
                                        <option disabled selected value>Pilih Movie</option>
                                        @foreach ($movies as $item)
                                            <option value="{{$item->id}}" @if($item->id == $ticket->id_movie) selected @endif>{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_movie')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection