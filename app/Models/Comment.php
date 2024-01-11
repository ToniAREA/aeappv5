<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'comments';

    public static $searchable = [
        'comment',
        'private_comment',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'wlist_id',
        'from_user_id',
        'comment',
        'private_comment',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function wlist()
    {
        return $this->belongsTo(Wlist::class, 'wlist_id');
    }

    public function from_user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }
}
