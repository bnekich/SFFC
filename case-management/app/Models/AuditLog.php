<?php
// filepath: d:\source\SFFC\case-management\app\Models\AuditLog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'details',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
