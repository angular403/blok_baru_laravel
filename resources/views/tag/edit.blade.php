@extends('template_backend.home')
@section('title')
    Update Category
@endsection

@section('content')

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>

        @endforeach
    @endif


    <form action="{{ route('category.update',$category->id)}}" method="POST">
        @csrf
        {{method_field('PUT')}}
        <div class="form-group">
            <label for="">Update Kategori</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" autocomplete="off">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </div>
    </form>
@endsection
