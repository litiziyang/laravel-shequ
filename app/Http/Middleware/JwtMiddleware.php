<?php


namespace App\Http\Middleware;

use Closure;
use Lcobucci\JWT\Parser;
use Illuminate\Http\Request;
use Lcobucci\JWT\Signer\Hmac\Sha256;


class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('token');

        if (!$token) {
            throw new \Exception('用户未登陆');
        } else {
            try {
                $parser = (new Parser())->parse($token);
                if (!$parser->verify(new Sha256(), config('app.jwt.secret'))) {
                    throw new \Exception('400,token错误');
                }
                if ($parser->isExpired()) {
                    throw new \Exception('token已经过期');
                } else {
                    $request['user_id']=$parser->getClaim('id');
                }
            } catch (\Exception $e) {
                throw new \Exception($e);
            }
        }
        return $next($request);
    }


}
