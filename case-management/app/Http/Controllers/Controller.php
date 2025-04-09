<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    /**
     * Log an action with customizable level and channel
     *
     * @param string $message The log message
     * @param string|null $action The action being performed
     * @param string|null $modelType The model type involved
     * @param mixed $modelId The model ID involved
     * @param array $extra Additional context data
     * @return void
     */

    // Example usage:
    // $this->logAction("User viewed home", 'info', "index", "Home");
    // $this->logAction("Debug info", 'debug', "index", "Home");

    protected function logAction(
        string $message,
        ?string $action = null,
        ?string $modelType = null,
        $modelId = null,
        array $extra = []
    ): void {

        // $channel = 'daily';
        $channel = 'audit';
        $level = 'debug';

        // TODO set this back to daily for development
        // switch to database logging and info level for non-development environments
        // $environment = env('APP_ENV');
        // if (!$environment === 'local') {
        //     $channel = 'audit';
        //     $level = 'info';
        // }

        $context = array_merge([
            'user_id' => auth()->id() ?? null,
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'ip_address' => request()->ip(),
        ], $extra);

        Log::channel($channel)->$level($message, $context);
    }
}
