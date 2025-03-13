<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use Illuminate\Support\Facades\DB;

class DatabaseLogger
{
  /**
   * Create a custom Monolog instance for database logging.
   *
   * @param array $config
   * @return Logger
   */
  public function __invoke(array $config)
  {
    $logger = new Logger('database');
    $logger->pushHandler(new class extends AbstractProcessingHandler {
      /**
       * Write the log record to the database.
       *
       * @param LogRecord $record
       */
      protected function write(LogRecord $record): void
      {
        DB::table('audit_logs')->insert([
          'user_id' => auth()->id() ?? null,
          'action' => $record->message, // Access message from LogRecord
          'model_type' => $record->context['model_type'] ?? null, // Context is an array in LogRecord
          'model_id' => $record->context['model_id'] ?? null,
          'details' => json_encode($record->context), // Store full context as JSON
          'created_at' => $record->datetime->format('Y-m-d H:i:s'), // Use LogRecord's timestamp
        ]);
      }
    });

    return $logger;
  }
}
