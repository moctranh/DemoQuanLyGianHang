<?php

namespace Modules\Manager\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $userRepo;
    
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function handle(Request $request, Closure $next)
    {
        $check = $this->userRepo->checkPermission([1,2]);
        if ($check)
            return $next($request);
        
        $request->session()->flash('errorMessage','Bạn không được phép truy cập');
        return redirect(route('home'));
    }
}
