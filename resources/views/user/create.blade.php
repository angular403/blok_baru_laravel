@extends('template_backend.home')
@section('title')
    Input user
@endsection

@section('content')

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>

        @endforeach
    @endif


    <form action="{{ route('user.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Input Nama user</label>
            <input type="text" class="form-control" name="name" id="name" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="">Input username</label>
            <input type="text" class="form-control" name="username" id="username" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="">Input Password</label>
            <input type="password" class="form-control" name="password" id="password" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="">Input Email user</label>
            <input type="email" class="form-control" name="email" id="email" autocomplete="off">
        </div>

        <div class="form-group">
           <div class="col-sm-3">
            <label for="">Level user</label>
            <select name="level" id="level" class="form-control">
                <option value="admin"> Adminstrator</option>
                <option value="penulis"> Penulis</option>
            </select>
           </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </div>
    </form>
@endsection
