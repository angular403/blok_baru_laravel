@extends('template_backend.home')
@section('title')
    Tambah tag
@endsection

@section('content')

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>

        @endforeach
    @endif


    <form action="{{ route('tag.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Input Nama Tag</label>
            <input type="text" class="form-control" name="name" id="name" autocomplete="off">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </div>
    </form>
@endsection
