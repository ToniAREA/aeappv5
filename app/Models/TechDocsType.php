<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TechDocsType extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'tech_docs_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function docTypeTechnicalDocumentations()
    {
        return $this->hasMany(TechnicalDocumentation::class, 'doc_type_id', 'id');
    }

    public function authorized_roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function authorized_users()
    {
        return $this->belongsToMany(User::class);
    }
}
