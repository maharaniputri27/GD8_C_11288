@extends('dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Ticket</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
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
                            <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Class</label>
                                    <input type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" placeholder="Masukkan Nama Ticket">
                                    @error('class')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Masukkan Price">
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
  
                                    <div class="form-group col-md-6">
                                        <label class="font-weight-bold">Movie</label>
                                        <select name="id_movie" id="id_movie" class="form-control @error('id_movie') is-invalid @enderror">
                                        <option disabled selected value>Pilih Movie</option>
                                        @foreach ($movies as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                    </div>
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
