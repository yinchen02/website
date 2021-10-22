<?php
namespace app\admin\middleware;
class Auth {
    public function handle($request, \Closure $next)
    {
        // 如果session不存在和不在登录页 则跳转登录页
        if (empty(session(config('admin.session_admin'))) && !preg_match("/login/",$request->pathinfo())){
            return redirect('/admin/login');
        }
        return $next($request);
    }
    public function end(\think\Response $response)
    {
        // 回调行为
    }
}