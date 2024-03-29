<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'todos';

    protected $fillable = ['user_id', 'done_flag', 'content', 'target_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
