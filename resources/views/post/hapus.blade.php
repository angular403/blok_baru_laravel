@extends('template_backend.home')
@section('title')
    Data post yang sudah dihapus
@endsection

@section('content')
@if (Session::has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@endif
<br><br>
    <br><br>
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Tag</th>
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
                         <li>{{$result->name}}</li>
                     </ul>
                   @endforeach
                </td>
                <td>
                    <img src="{{ asset($row->gambar)}}" width="100px" class="img-fluid"/>
                </td>
                <td>
                    <form action="{{ route('post.kill',$row->id)}}" method="POST">
                        @csrf
                        {{method_field('DELETE')}}
                        <a href="{{ route('post.restore',$row->id)}}" class="btn btn-primary btn-sm"> Restore</a>

                        <button type="submit" class="btn btn-danger btn-sm"> Delete</button>
                        {{-- <a href="#" class="btn btn-danger btn-sm delete" user-id={{$row->id}}> Hapus</a> --}}
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
