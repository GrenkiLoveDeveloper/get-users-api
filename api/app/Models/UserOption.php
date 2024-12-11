<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $ip
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\UserOptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserOption query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserOption whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserOption whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserOption whereUserId($value)
 * @mixin \Eloquent
 */
class UserOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
