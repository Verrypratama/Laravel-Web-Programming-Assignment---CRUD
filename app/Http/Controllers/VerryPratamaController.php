<?php

namespace App\Http\Controllers;

use App\Models\VerryPratama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerryPratamaController extends Controller
{
     // Read data
    public function masuk(){
        return view('auth.login');
    }
    public function index(Request $request)
    {
        $alldata = VerryPratama::all();
        return view('index', ['data' => $alldata]);
    }

    public function edit($id)
    {
    $DataEdite = VerryPratama::find($id);
    return view('edit', ['data' => $DataEdite, 'id' => $id]);
    }

    public function add()
    {
        return view('add');
    }

    public function lokal()
    {
        $data = VerryPratama::all();
        return view('lokal', ['data' => $data]);
    }


    public function addData(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'namadaerah' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $path = 'images/';
        $filename = null;
    
        if ($request->has('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);
        }
    
        $newdata = new VerryPratama();
        $newdata->nama = $request->nama;
        $newdata->harga = $request->harga;
        $newdata->namadaerah = $request->namadaerah;
        $newdata->foto = $filename ? $path . $filename : null; // Assigning the photo path to the 'foto' property
        
        $newdata->save();
        return redirect('/index');
    }
    


    public function editData(Request $request)
    {
    $data = VerryPratama::findOrFail($request->id);

    $data->nama = $request->nama;
    $data->harga = $request->harga;
    $data->namadaerah = $request->namadaerah;

    if ($request->hasFile('foto')) {
        $path = 'images/';
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move($path, $filename);
        $data->foto = $path . $filename;
    }

    $data->save();

    return redirect('/index');
    }


    public function deleteData($id)
    {
        $dataDelate = VerryPratama::find($id);
        if ($dataDelate) {
            $dataDelate->delete();
        };
        return redirect('/index');
    }

    public function authenticated(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email Wajib DIisi',
            'password.required' => 'Password Wajib DIisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            return redirect("/index");
        }else {
            return redirect('/sesi')->withErrors('Username Dan Pasword yang adana masukkan tidak falid');
        };
    }
}
