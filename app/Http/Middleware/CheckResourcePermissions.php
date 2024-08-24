<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckResourcePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $model
     * @param  string  $permissionPrefix
     * @return mixed
     */
    public function handle($request, Closure $next, $model, $permissionPrefix)
    {
        $actions = [
            'index' => 'view',
            'create' => 'add',
            'store' => 'add',
            'show' => 'view',
            'edit' => 'edit',
            'update' => 'edit',
            'destroy' => 'delete',
            'delete' => 'delete',
            'sms' => 'send_sms',
            'send' => 'send_sms',
            'updateTechnician' => 'edit',
            'noResponseIndex' => 'view',
            'noResponseTwiceIndex' => 'view',
        ];

        $action = $request->route()->getActionMethod();

        if (isset($actions[$action])) {
            $permission = $actions[$action] . '_' . $permissionPrefix;
            if (!Auth::user()->can($permission)) {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to access this resource.');
            }
        }

        return $next($request);
    }
}

