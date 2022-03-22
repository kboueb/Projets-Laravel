<?php

namespace App\Http\Controllers;

use App\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etudiants = Etudiant::orderByDesc('id')->get();
        return response()->json($etudiants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max:25',
            'phone' => 'required | min:9',
            'email' => 'required',
            'password' => 'required',
            'photo' => 'required',
            'address' => 'required | max:50',
            'gender' => 'required'
        ]);

        $etudiant =new Etudiant;

        $etudiant->name = $request->input('name');
        $etudiant->phone = $request->input('phone');
        $etudiant->email = $request->input('email');
        $etudiant->bcrypt($request->input('password'));
        $etudiant->photo = $request->input('photo');
        $etudiant->address = $request->input('address');
        $etudiant->gender = $request->input('gender');
        $etudiant->save();

        return response()->json([
            'message' => 'Etudiant crée avec succès'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $etudiant = Etudiant::findorfail($id);

        return response()->json($etudiant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required | max:25',
            'phone' => 'required | min:9',
            'email' => 'required',
            'password' => 'required',
            'photo' => 'required',
            'address' => 'required | max:50',
            'gender' => 'required'
        ]);

        $etudiant = Etudiant::findorfail($id);

        $etudiant->name = $request->input('name');
        $etudiant->phone = $request->input('phone');
        $etudiant->email = $request->input('email');
        $etudiant->password = bcrypt($request->input('password'));
        $etudiant->photo = $request->input('photo');
        $etudiant->address = $request->input('address');
        $etudiant->gender = $request->input('gender');
        $etudiant->save();

        return response()->json([
            'message' => 'Etudiant modifié avec succès'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etudiant = Etudiant::findorfail($id);


        $etudiant->delete();

        return response()->json([
            'message' => 'Etudiant supprimé avec succès'
        ]);
    }
}
