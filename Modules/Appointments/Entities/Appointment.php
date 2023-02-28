<?php

namespace Modules\Appointments\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Doctors\Entities\Doctor;
use Modules\Pateints\Entities\Patient;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Pateints\Database\factories\PatientFactory::new();
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
