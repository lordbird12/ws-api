<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'users';
    protected $softDelete = true;

    protected $hidden = ['password', 'deleted_at'];

    //////////////////////////////////////// format //////////////////////////////////////

    public function getImageAttribute($value)
    {
        return ($value ? url($value) : null);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d/m/Y H:i:s');
    }

    //////////////////////////////////////// relation //////////////////////////////////////

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function recruitment_companies()
    {
        return $this->hasMany(RecruitmentCompany::class);
    }

    public function products()
    {
        return $this->hasMany(ProductServiceCompany::class);
    }

    public function scraps()
    {
        return $this->hasMany(ScrapCompany::class);
    }

    public function puchases()
    {
        return $this->hasMany(PuchaseCompany::class);
    }

    public function logistics()
    {
        return $this->hasMany(LogisticCompany::class);
    }

    public function searchs()
    {
        return $this->hasMany(SearchLogCompany::class);
    }

}
