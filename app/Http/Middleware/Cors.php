<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Permitir todas as origens em ambientes de desenvolvimento/teste
        if (!app()->environment('production')) {
            $allowedOrigins = '*';
        } else {
            // Em produção, defina o domínio permitido
            $allowedOrigins = 'https://your-production-domain.com';  // Substitua pelo seu domínio de produção
        }

        $response = $next($request);

        // Configurar os cabeçalhos de CORS para permitir tudo
        return $response
            ->header('Access-Control-Allow-Origin', $allowedOrigins)
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, X-Token-Auth, Authorization, Origin, Accept, Cache-Control, Pragma')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Expose-Headers', 'Authorization, Content-Type, X-Token-Auth')
            ->header('Accept', 'application/json')
            ->header('Vary', 'Origin');
    }
}
