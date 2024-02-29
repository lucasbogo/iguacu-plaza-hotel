    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class RoomService extends Model
    {
        use HasFactory;

        protected $fillable = [
            'occupant_id',
            'service_type_id',
            'cost',
            'service_date',
            'observations',
            'is_paid'
        ];

        public function occupant()
        {
            return $this->belongsTo(Occupant::class);
        }

        public function serviceType()
        {
            return $this->belongsTo(ServiceType::class);
        }
    }
