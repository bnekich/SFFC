<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogAuditActions
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $method = $request->method();
        $route = $request->route();
        $action = $this->getActionDescription($method, $route->getName());

        // Detect model from route parameters
        $modelType = null;
        $modelId = null;
        if ($route) {
            if ($user = $route->parameter('user')) {
                $modelType = 'App\\Models\\User';
                $modelId = is_object($user) ? $user->id : $user;
            } elseif ($role = $route->parameter('role')) {
                $modelType = 'Spatie\\Permission\\Models\\Role'; // Assuming spatie/laravel-permission
                $modelId = is_object($role) ? $role->id : $role;
            } elseif ($permission = $route->parameter('permission')) {
                $modelType = 'Spatie\\Permission\\Models\\Permission';
                $modelId = is_object($permission) ? $permission->id : $permission;
            }
        }

        Log::channel('audit')->info($action, [
            'model_type' => $modelType,
            'model_id' => $modelId,
            'user_id' => auth()->id() ?? null,
            'ip' => $request->ip(),
            'status' => $response->getStatusCode(),
            'route' => $route->uri(), // Extra context for clarity
        ]);

        return $response;
    }

    protected function getActionDescription(string $method, ?string $routeName): string
    {
        $baseAction = match ($method) {
            'GET' => 'Viewed',
            'POST' => 'Created',
            'PUT', 'PATCH' => 'Updated',
            'DELETE' => 'Deleted',
            default => 'Performed action on',
        };

        $resource = $routeName ? str_replace('.', ' ', $routeName) : 'resource';
        return "$baseAction $resource";
    }
}
