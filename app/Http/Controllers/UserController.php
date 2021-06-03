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
        $is_admin = $user_id;
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

        // $totalOpen = DB::table('job as j')
        //        ->join('miviswf as w', 'w.mivisid', '=', 'j.mivisjobid')
        //        ->whereIn('w.status', ['OPEN', 'AMEND'])
        //        ->count();

        // DB::table('website_tags')
        // ->join('assigned_tags', 'website_tags.id', '=', 'assigned_tags.tag_id')
        // ->select('website_tags.id as id', 'website_tags.title as title', DB::raw("count(assigned_tags.tag_id) as count"))
        // ->groupBy('website_tags.id')
        // ->get();
        
        //$livros = '';
        // $livros = DB::select("SELECT  
        //                         u.user_id, 
        //                         u.fk_status_id, 
        //                         s.id as status_id,
        //                         s.nome as status,
        //                      FROM users_livro as u
        //                      INNER JOIN status as s ON u.fk_status_id = s.id
        //                      WHERE u.user_id = $user_id and status = 'Lido'");
        
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

}
