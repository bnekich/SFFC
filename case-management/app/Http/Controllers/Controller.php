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
     * @param string $level Log level (info, debug, warning, etc.)
     * @param string $channel Logging channel
     * @param string|null $action The action being performed
     * @param string|null $modelType The model type involved
     * @param mixed $modelId The model ID involved
     * @param array $extra Additional context data
     * @return void
     */

    // Example usage:
    // $this->logAction("User viewed home", 'info', 'audit', "index", "Home");
    // $this->logAction("Debug info", 'debug', 'daily', "index", "Home");

    protected function logAction(
        string $message,
        string $level = 'info',
        string $channel = 'audit',
        ?string $action = null,
        ?string $modelType = null,
        $modelId = null,
        array $extra = []
    ): void {
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
