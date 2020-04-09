<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Arr;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('created_at','desc')
                     ->paginate(2);
        return view('user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $pesan = [
            'required' => ':attribute Harus Diisi Terlebih Dahulu',
            'max' => ':attribute Harus Diisi Maksimal :max Karakter',
            'min' => ':attribute Harus Diisi Minimal :min Karakter',
        ];

        $validasi = Validator::make($data,[
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|max:100|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ],$pesan);

        if($validasi->Fails())
        {
            return redirect()->route('user.create')->withInput()->withErrors($validasi);
        }

        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect()->route('user.index')->with('success','Data User Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->all();

        $pesan = [
            'required' => ':attribute Harus Diisi Terlebih Dahulu',
            'max' => ':attribute Harus Diisi Maksimal :max Karakter',
            'min' => ':attribute Harus Diisi Minimal :min Karakter',
        ];

        $validasi = Validator::make($data,[
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ],$pesan);

        if($validasi->Fails())
        {
            return redirect()->route('user.create')->withInput()->withErrors($validasi);
        }

        if($request->input('password'))
        {
            $data['password'] = bcrypt($data['password']);
        }
        else
        {
            $data = Arr::except($data,['password']);
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success','Data User Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success','Data User Berhasil Dihapus');
    }
}
