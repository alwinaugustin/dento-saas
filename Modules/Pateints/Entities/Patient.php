<?php

namespace Modules\Pateints\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patient';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Pateints\Database\factories\PatientFactory::new();
    }
}
