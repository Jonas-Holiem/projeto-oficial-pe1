<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContatoMail;

class ContatoController extends Controller
{
    public function showForm()
    {
        return view('contato');
    }

    public function sendMessage(Request $request)
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'mensagem' => 'required|string',
        ]);

        // Enviar e-mail com os dados do formulário
        try {
            Mail::to('seuemail@dominio.com')->send(new ContatoMail($validated));

            return back()->with('mensagem_sucesso', 'Mensagem enviada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('mensagem_erro', 'Houve um erro ao enviar sua mensagem.');
        }
    }
}
