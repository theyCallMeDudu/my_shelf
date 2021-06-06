<?php

namespace App\Http\Controllers;

use App\Models\FotoUser;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function usuarios() {
        $users = User::all();
        $is_admin = Auth::id();

        return view('admin.gestao', compact('users', 'is_admin'));
    }

    public function minhaConta() {
        $user = Auth::user();
        $user_id = Auth::id();
        $is_admin = Auth::user()->is_admin;
        $status = Status::all();
        
        // Join livros lidos
        $lidos = DB::table('users_livro as u')
        ->join('users', 'u.user_id', '=', 'users.id')
        ->join('status as s', 'u.fk_status_id', '=', 's.id')
        ->whereIn('s.nome', ['Lido'])
        ->whereIn('users.id', [$user_id])
        ->count();

        // Join livros sendo lidos (lendo)
        $lendo = DB::table('users_livro as u')
        ->join('users', 'u.user_id', '=', 'users.id')
        ->join('status as s', 'u.fk_status_id', '=', 's.id')
        ->whereIn('s.nome', ['Lendo'])
        ->whereIn('users.id', [$user_id])
        ->count();
        
        // Join livros para ler (quero ler)
        $ler = DB::table('users_livro as u')
        ->join('users', 'u.user_id', '=', 'users.id')
        ->join('status as s', 'u.fk_status_id', '=', 's.id')
        ->whereIn('s.nome', ['Quero ler'])
        ->whereIn('users.id', [$user_id])
        ->count();

        // Total de livros na estante
        $total = DB::table('users_livro as u')
        ->join('users', 'u.user_id', '=', 'users.id')
        ->whereIn('users.id', [$user_id])
        ->count();
        
        return view('minha-conta', compact('user', 'is_admin', 'status', 'lidos', 'lendo', 'ler', 'total'));
    }

    private function uploadFoto(Request $request) {
        $foto = $request->file('foto');

        $uploadFoto = $foto->store('foto', 'public');

        return $uploadFoto;
    }

    public function removeFoto(Request $request) {

        $foto = $request->get('fotoUser');
        
        // Remover a imagem da pasta
        if (Storage::disk('public')->exists($foto)) {
            Storage::disk('public')->delete($foto);
        }

        // Remover imagem do banco
        $deletaFoto  = FotoUser::where('nome', $foto);
        $deletaFoto->delete();

        return redirect('minha-conta')->with('msg', 'Foto de perfil removida com sucesso.');
    }

    public function update(Request $request) {

        $data = $request->all();

        // Upload de imagem
        if ($request->hasFile('foto')) {
            $foto = $this->uploadFoto($request);

            FotoUser::create([
                 'nome' => $foto,
                 'user_id' => $request->id
            ]);
         }
        
        FotoUser::findOrFail($request->id)->update($data);
        User::findOrFail($request->id)->update($data);
        
        return redirect('/minha-conta')->with('msg', 'Conta editada com sucesso!');
    }

    public function excluiUsuario($id) {

        User::findOrFail($id)->delete();

        return redirect()->route('no-user');
    }

    public function noUser() {
        return view('no-user');
    }

    public function concedeAcesso(Request $request){
        //dd($request->user_id);
        User::where(['id' => $request->user_id])->update([
            'is_admin' => 1,
        ]);

        return redirect('/admin/gestao')->with('msg', 'Acesso concedido com sucesso!');
    }

    public function revogaAcesso(Request $request){
        //dd($request->user_id_not);
        User::where(['id' => $request->user_id_not])->update([
            'is_admin' => null,
        ]);

        return redirect('/admin/gestao')->with('msg', 'Acesso revogado com sucesso!');
    }

}
