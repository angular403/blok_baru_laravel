@extends('template_backend.home')
@section('title')
    Data user
@endsection

@section('content')
@if (Session::has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@endif
<br><br>
    <a href="{{ route('user.create')}}" class="btn btn-info btn-sm"> Tambah User</a>
    <br><br>
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
            <th colspan="2">Action</th>
        </tr>

        @foreach ($user as $row)
            <tr>
                <td>{{ $loop->iteration + ($user->perpage() * ($user->currentPage() -1))}}</td>
                <td>{{ $row->name}}</td>
                <td>{{ $row->username}}</td>
                <td>{{ $row->email}}</td>
                <td>{{ $row->level}}</td>
                <td>
                    <form action="{{ route('user.destroy',$row->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('user.edit',$row->id) }}" class="btn btn-primary btn-sm"> Edit</a>

                        <a href="#" class="btn btn-danger btn-sm delete" user-id={{$row->id}}> Hapus</a>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    {{$user->links()}}
@endsection

@section('footer')
    <script>
        $('.delete').click(function(){
            var user_id = $(this).attr('user-id');
            swal({
                    title: "Yakin ?",
                    text: "Ingin Menghapus Data user Ini ??",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                     window.location = "/user/"+user_id+"/delete";
                    } else {
                        swal("Data Tidak Jadi Dihapus");
                    }
                    });
        });
    </script>
@endsection
