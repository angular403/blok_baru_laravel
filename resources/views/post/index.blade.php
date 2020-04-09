@extends('template_backend.home')
@section('title')
    Data post
@endsection

@section('content')
@if (Session::has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@endif
<br><br>
    <a href="{{ route('post.create')}}" class="btn btn-info btn-sm"> Tambah</a>
    <br><br>
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Daftar Tag</th>
            <th>Pembuat</th>
            <th>Gambar</th>
            <th colspan="2">Action</th>
        </tr>

        @foreach ($post as $row)
            <tr>
                <td>{{ $loop->iteration + ($post->perpage() * ($post->currentPage() -1))}}</td>
                <td>{{ $row->judul}}</td>
                <td>{{ $row->category->name}}</td>
                <td>@foreach ($row->tag as $result)
                     <ul>
                         <h6><span class="badge badge-primary">{{$result->name}}</span></h6>
                     </ul>
                   @endforeach
                </td>
                <td>{{ $row->users->name }}</td>
                <td>
                    <img src="{{ asset($row->gambar)}}" width="100px" class="img-fluid"/>
                </td>
                <td>
                    <form action="{{ route('post.destroy',$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('post.edit',$row->id) }}" class="btn btn-success btn-sm"> Edit</a>

                        <a href="#" class="btn btn-danger btn-sm delete" user-id={{$row->id}}> Hapus</a>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    {{$post->links()}}
@endsection

@section('footer')
    <script>
        $('.delete').click(function(){
            var user_id = $(this).attr('user-id');
            swal({
                    title: "Yakin ?",
                    text: "Ingin Menghapus Data post Ini ??",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                     window.location = "/post/"+user_id+"/delete";
                    } else {
                        swal("Data Tidak Jadi Dihapus");
                    }
                    });
        });
    </script>
@endsection
