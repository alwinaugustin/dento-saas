<?php

namespace Modules\Pateints\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Appointments\Entities\Appointment;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Pateints\Database\factories\PatientFactory::new();
    }
    /**
     * Appointments
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }
}
