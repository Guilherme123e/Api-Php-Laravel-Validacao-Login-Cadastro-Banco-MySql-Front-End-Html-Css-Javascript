<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validação com mensagens customizadas
        $request->validate([
            'nome' => 'required|string|max:100',
            'cpf' => 'required|string|size:11|unique:usuarios,cpf',
            'rg' => 'required|string|min:5|max:20|unique:usuarios,rg',
            'data_nascimento' => 'required|date|date_format:Y-m-d|before:today|after:1990-01-01',
            'endereco' => 'required|string|max:200',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:usuarios,email|confirmed',
            'senha' => 'required|string|min:6|confirmed',
            'genero' => 'required|string|in:masculino,feminino,outro',
        ], [
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'rg.unique' => 'Este RG já está cadastrado.',
            'email.unique' => 'Este email já está cadastrado.',
            'email.confirmed' => 'A confirmação de email não confere.',
            'senha.confirmed' => 'A confirmação de senha não confere.',
            'data_nascimento.after' => 'A data de nascimento deve ser posterior a 01/01/1990.',
            'data_nascimento.before' => 'A data de nascimento deve ser anterior a hoje.',
        ]);

        // Criação do usuário
        $user = new User();
        $user->setTable('usuarios'); // Aponta para a tabela correta
        $user->nome = $request->nome;
        $user->cpf = $request->cpf;
        $user->rg = $request->rg;
        $user->data_nascimento = $request->data_nascimento;
        $user->endereco = $request->endereco;
        $user->telefone = $request->telefone;
        $user->email = $request->email;
        $user->senha_hash = Hash::make($request->senha);
        $user->genero = $request->genero;
        $user->save();

        return response()->json(['message' => 'Conta criada com sucesso!'], 201);
    }







    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'senha' => 'required|string|min:6',
    ]);

    // Procurar usuário pelo email
    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->senha, $user->senha_hash)) {
        return response()->json([
            'success' => true,
            'redirect' => 'cadastro-sucesso.html'
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Email ou senha inválidos.'
        ], 401);
    }
}

}
