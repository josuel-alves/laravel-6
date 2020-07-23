<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    // Criando um método
    public function teste()
    {
        
        /*
            O ideal é que as rotas não contenham lógica de programação
            A rota deve apenas ddirecionar para outro local realizar a lógica
        */
        
        return 'Teste Controller';
    }

}
