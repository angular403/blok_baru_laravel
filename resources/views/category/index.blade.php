@extends('template_backend.home')
@section('title')
    Data Category
@endsection

@section('content')
@if (Session::has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@endif
<br><br>
    <a href="{{ route('category.create')}}" class="btn btn-info btn-sm"> Tambah</a>
    <br><br>
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Slug</th>
            <th colspan="2">Action</th>
        </tr>

        @foreach ($category as $row)
            <tr>
                <td>{{ $loop->iteration + ($category->perpage() * ($category->currentPage() -1))}}</td>
                <td>{{ $row->name}}</td>
                <td>{{ $row->slug}}</td>
                <td>
                    <form action="{{ route('category.destroy',$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('category.edit',$row->id) }}" class="btn btn-primary btn-sm"> Edit</a>

                        <a href="#" class="btn btn-danger btn-sm delete" user-id={{$row->id}}> Hapus</a>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    {{$category->links()}}
@endsection

@section('footer')
    <script>
        $('.delete').click(function(){
            var user_id = $(this).attr('user-id');
            swal({
                    title: "Yakin ?",
                    text: "Ingin Menghapus Data Category Ini ??",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                     window.location = "/category/"+user_id+"/delete";
                    } else {
                        swal("Data Tidak Jadi Dihapus");
                    }
                    });
        });
    </script>
@endsection
