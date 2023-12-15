<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permissions): Response
    {

        /**
         * Como estou recebendo uma string e preciso de array, uso o explode para
         * transformar $permissions em um array
         */
        $permissions = explode(',', $permissions);

         // Verificar se o usuário tem pelo menos uma das permissões necessárias
         foreach ($permissions as $permission) {
            if ($request->user()->hasPermission($permission)) {
                return $next($request);
            }
        }

        // Caso o usuário não tenha permissão, você pode redirecionar ou retornar uma resposta de erro
        abort(403, 'Sem permissão para acessar esta página.');
    }
}
