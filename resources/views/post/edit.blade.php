@extends('template_backend.home')
@section('title')
    Update post
@endsection

@section('content')

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>

        @endforeach
    @endif


    <form action="{{ route('post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Judul</label>
            <input type="text" class="form-control" name="judul" id="judul" value="{{$post->judul}}" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="">Kategori</label>
            <select name="category_id" class="form-control">
                <option value="" holder>Pilih Kategori</option>
                @foreach ($category as $result)
                <option value="{{$result->id}}"
                    @foreach ($post->tag as $value)
                        @if ($result->id == $value->id)
                            Selected
                        @endif
                    @endforeach
                    >{{$result->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for=""></label>
            <select name="tag[]" class="form-control select2" multiple > Pilih Tags
                @foreach ($tag as $result)
                <option value="{{$result->id}}" @foreach ($post->tag as $value)
                    @if ($result->id == $value->id)
                        Selected
                    @endif
                @endforeach>{{$result->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">konten</label>
            <textarea name="content" class="form-control">{{ $post->content}}</textarea>
        </div>

        <div class="form-group">
            <label for="">Thumbnail</label>
            <input type="file" class="form-control" name="gambar" autocomplete="off">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
        </div>
    </form>
@endsection
