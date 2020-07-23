<?php 

use Illuminate\Support\Facades\Route;

/*
LINHA DE COMANDO FREQUENTES: 

// LISTA TODAS AS ROTAS DE SEU PROJETO
php artisan route:list

// LIMPAR CACHE DA APLICAÇÃO, ALGUM COTROLLER PODE DAR ERRO, PQ ESTÁ LENDO DO CACHE
php artisan route:cache
*/


/*
SIMPLIFICANDO middleware, prefix, namespace
*/
Route::group([
    'middleware' => [],
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function(){
    
    Route::get('/perfil', 'TesteController@teste')->name('admin.perfil');
    
    Route::get('/usuario', function () {
        return redirect()->route('admin.perfil');
    })->name('usuario');

});



/*

CRIANDO UM NOVO CONTROLLER

1: VÁ PARA O TERMINAL CMD
2: NA RAIZ DO PROJETO DIGITE:     
php artisan make:controller Admin\TesteController

*/


/*
middleware pode ser string ou array
middleware('auth')
middleware(['auth', 'abc', 'abc'])
*/
Route::get('/admin/funcionarios', function () {
    return 'funcionarios admin';
})->middleware('auth');

Route::get('/admin/comercial', function () {
    return 'comercial admin';
})->middleware('auth');

Route::get('/admin/servicos', function () {
    return 'servicos admin';
})->middleware('auth');


// Os middleware acima, tive que passar o nome um por um, se um dia tiver que alterar o nome
// vai ficar bem trabalhoso alterar em todos
// Uma alternativa é: 


// GRUPO DE ROTAS
Route::middleware([])->group(function(){
//Route::middleware(['auth'])->group(function(){

    //não precisa mais passar o middleware como no exemplo acima
    Route::get('/admin/produtos', function () {
        return 'Financeiro admin';
    });

    Route::get('/admin/precos', function () {
        return 'precos admin';
    });

    // PREFIXOS DE ROTAS
    Route::prefix('admin')->group(function () {
        
        // não precisa passar mais o /admin
        Route::get('/Comentarios', function () {
            return 'Comentarios admin';
        });
        
        // Controller criado em /Http/Controllers/Admin/TesteController
        // Admin\ = Diretório onde está o controller
        //TesteController = Controller
        //teste = método
        Route::get('/', 'Admin\TesteController@teste');

        // Para não precisar mais ficar passando o Admin\ que é o diretório do controller
        // Faça o seguinte: 
        Route::namespace('Admin')->group(function(){
            
            // Não precisa passar o Admin\
            Route::get('/financeiro', 'TesteController@teste');
            
            // Prefixo para name
            Route::name('admin.')->group(function(){
                
                // Trabalhando com name em Controller
                Route::get('/dashboard', 'TesteController@teste')->name('dashboard');
                
                // Redirecionando utilizando ROTAS COM NOMES
                Route::get('/home', function () {
                    return redirect()->route('admin.dashboard');
                })->name('home');

            });

        });

    });
});




Route::get('/login', function () {
    return 'Login';
})->name('login');


// Rotas nomeadas
Route::get('/redireciona3', function () {
    return redirect()->route('url.name');// Chame a rota pelo name
});
// Dando nome para uma rota, assim mesmo que mude o name-url, não tem problema, 
//pq o que é chamado é o nome da rota que é url.name
Route::get('/novo-nome-url', function () {
    return 'Minha url /nome-url';
})->name('url.name'); //Declare o nome da rota




//Em casos de views muito simples, nem precisa passar por um controller como os exemplos abaixo
//termos = view
//contato = página que será dircionada essa view termos
Route::view('termos', 'contato');
// View simples com parâmetros
Route::view('mais', 'contato', ['id' => 'teste']);

// Redirect resumido
Route::redirect('/redireciona0', '/redireciona2');

Route::get('/redireciona2', function () {
    return 'redireciona2';
});

// Redirect
Route::get('/redireciona1', function () {
    return redirect('/redireciona2');
});



// Route com parâmetro opcional
Route::get('produtos/{idProduto?}', function($idProduto = false){
    return "Produto(s) da categoria: {$idProduto}";
});

// Route com parâmetro dinâmico entre dois outros fixos
Route::get('blog/{dado}/artigo', function($dado){
    return "Produtos da categoria: {$dado}";
});

// Route com parâmetro
Route::get('blog/{dado}', function($dado){
    return "Produtos da categoria: {$dado}";
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quem-somos', function () {
    return view('quem-somos');
});

Route::get('/servicos', function () {
    return view('servicos');
});

Route::get('/contato', function () {
    return view('contato');
});

/*
// Aceita todos os tipos de requisições http
Route::any('/any', function () {
    return 'Any';
});

//Define requisições específicas
Route::match(['get', 'post', 'put'], '/any', function () {
    return 'Any get and post and put';
});
*/