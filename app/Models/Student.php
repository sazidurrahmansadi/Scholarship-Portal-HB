<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // use HasFactory;

    public function address()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
    public function student_address()
    {
        return  $this->address();
    }

    public function documents()
    {
        return $this->morphMany(Address::class, 'documentable');
    }

    public function student_documents()
    {
        return  $this->documents();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function degree_information()
    {
        return $this->hasOne(Degree::class);
    }

    
    
    protected static function booted()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model){
            if (session()->has('tenant_id')) {
                $model->tenant_id = session()->get('tenant_id');
            }
        });
    }
}
