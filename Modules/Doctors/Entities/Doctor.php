<?php

namespace Modules\Doctors\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'doctors';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Pateints\Database\factories\PatientFactory::new();
    }
}
