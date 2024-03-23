<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function forRoleToDos()
    {
        return $this->belongsToMany(ToDo::class);
    }

    public function forRoleAppointments()
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function forRoleWlists()
    {
        return $this->belongsToMany(Wlist::class);
    }

    public function authorizedRolesProductCategories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function authorizedRolesAssetCategories()
    {
        return $this->belongsToMany(AssetCategory::class);
    }

    public function authorizedRolesDocumentations()
    {
        return $this->belongsToMany(Documentation::class);
    }

    public function authorizedRolesContentCategories()
    {
        return $this->belongsToMany(ContentCategory::class);
    }

    public function authorizedRolesTechnicalDocumentations()
    {
        return $this->belongsToMany(TechnicalDocumentation::class);
    }

    public function authorizedRolesDocumentationCategories()
    {
        return $this->belongsToMany(DocumentationCategory::class);
    }

    public function authorizedRolesContentPages()
    {
        return $this->belongsToMany(ContentPage::class);
    }

    public function authorizedRolesTechDocsTypes()
    {
        return $this->belongsToMany(TechDocsType::class);
    }

    public function authorizedRolesVideoTutorials()
    {
        return $this->belongsToMany(VideoTutorial::class);
    }

    public function authorizedRolesFaqCategories()
    {
        return $this->belongsToMany(FaqCategory::class);
    }

    public function authorizedRolesFaqQuestions()
    {
        return $this->belongsToMany(FaqQuestion::class);
    }

    public function authorizedRolesVideoCategories()
    {
        return $this->belongsToMany(VideoCategory::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
