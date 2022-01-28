<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int    id
 * @property int    user_id
 * @property string title
 * @property string phone
 * @property string description
 * @property Carbon updated_at
 * @property Carbon created_at
 *
 * @property User   user
 */
class Company extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'companies';

    /**
     * @var string[]
     */
    protected $fillable = [
        'title', 'phone', 'description',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}