<?php

namespace App\Http\Controllers;

use App\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = Auth::user()->contatos;
        return view('contatos.index', compact('contatos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contatos.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(Auth::user());
        // dd($request->all());

        // $usuario = Auth::user();

        // Contato::create([
        //     'nome' => $request->nome,
        //     'telefone' => $request->telefone,
        //     'user_id' => $usuario->id
        // ]);
        if ($request->foto_contato) {
                $request->validate([
                    'foto_contato' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $imageName = time().'.'.$request->foto_contato->getClientOriginalExtension();
                $request->foto_contato->move(public_path('images'), $imageName);

                $request->merge(['foto' => $imageName]);
        }

        try {
            Auth::user()->contatos()->create($request->except(['foto_contato']));
            flash('Salvo com sucesso')->success();
        }catch (\Exception $e) {
            flash('Ocorreu um erro ao salvar')->error();

            return back()->withInput();
        }

        return redirect()->route('contatos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function show(Contato $contato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contato $contato)
    {
        //dd($contato);
        return view('contatos.form', compact('contato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contato $contato)
    {
        //dd($request->all(), $contato);
        try {
            $contato->update($request->all());
            flash('Atualizado com sucesso')->success();
        }catch (\Exception $e) {
            flash('Ocorreu um erro ao atualizar')->error();
            return back()->withInput();
        }

        return redirect()->route('contatos.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contato $contato)
    {
        //
    }
}
