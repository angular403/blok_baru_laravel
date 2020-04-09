@extends('template_backend.home')
@section('title')
    Data tag
@endsection

@section('content')
@if (Session::has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@endif
<br><br>
    <a href="{{ route('tag.create')}}" class="btn btn-info btn-sm"> Tambah</a>
    <br><br>
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Slug</th>
            <th colspan="2">Action</th>
        </tr>

        @foreach ($tag as $row)
            <tr>
                <td>{{ $loop->iteration + ($tag->perpage() * ($tag->currentPage() -1))}}</td>
                <td>{{ $row->name}}</td>
                <td>{{ $row->slug}}</td>
                <td>
                    <form action="{{ route('tag.destroy',$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('tag.edit',$row->id) }}" class="btn btn-primary btn-sm"> Edit</a>

                        <a href="#" class="btn btn-danger btn-sm delete" user-id={{$row->id}}> Hapus</a>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    {{$tag->links()}}
@endsection

@section('footer')
    <script>
        $('.delete').click(function(){
            var user_id = $(this).attr('user-id');
            swal({
                    title: "Yakin ?",
                    text: "Ingin Menghapus Data tag Ini ??",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                     window.location = "/tag/"+user_id+"/delete";
                    } else {
                        swal("Data Tidak Jadi Dihapus");
                    }
                    });
        });
    </script>
@endsection
