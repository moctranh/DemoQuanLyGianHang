<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected $userRepo;
    
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function handle(Request $request, Closure $next, ...$permissions)
    {
        $check = $this->userRepo->checkPermission($permissions);
        if ($check)
            return $next($request);
        
        $request->session()->flash('errorMessage','Bạn không được phép truy cập');
        return redirect(route('home'));
    }
}
