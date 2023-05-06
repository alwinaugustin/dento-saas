<?php

namespace Modules\Pateints\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Appointments\Entities\Appointment;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'patients';

    protected $guarded = [];

    const DELETED_AT = 'deleted_at';

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

     public static function boot() {
        parent::boot();
        self::deleting(function($patient) { 
            // before delete() method call this
             $patient->appointments()->each(function($appointment) {
                $appointment->delete(); // <-- direct deletion
             });

        });
    }
}
