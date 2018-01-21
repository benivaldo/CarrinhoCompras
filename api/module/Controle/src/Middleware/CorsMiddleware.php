<?php 
declare(strict_types=1);

/*namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
 
    public function handle($request, Closure $next)
    {
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
        ];

        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}*/

namespace Controle\Middleware;




use Interop\Http\Middleware\DelegateInterface;
use Interop\Http\Middleware\ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Stratigility\Delegate\CallableDelegateDecorator;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response;
use Zend\Stratigility\Next;

class CorsMiddleware implements ServerMiddlewareInterface
{
  
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        return $this->process($request, new CallableDelegateDecorator($next, $response));
    }
    
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
        ];
        if ($request->getMethod() == 'OPTIONS') {
            return new JsonResponse(['Method' => 'GET']);
        }
        
 
        
        return new Response('body', 200, $headers);
        
        return '222';
    }
    
    
}