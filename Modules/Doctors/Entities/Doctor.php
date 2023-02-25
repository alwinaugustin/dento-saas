<?php

namespace Modules\Doctors\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Pateints\Database\factories\PatientFactory::new();
    }
}
