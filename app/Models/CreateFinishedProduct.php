<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateFinishedProduct extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const SHIFT_SELECT = [
        '1' => 'Prva',
        '2' => 'Druga',
        '3' => 'Treca',
    ];

    public $table = 'create_finished_products';

    protected $dates = [
        'created_at',
        'expiry_date',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'shift',
        'user_id',
        'created_at',
        'expiry_date',
        'processing_spent_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function products()
    {
        return $this->belongsToMany(ProductsList::class);
    }

    public function halfProducts()
    {
        return $this->belongsToMany(HalfProduct::class, 'create_finished_product_half_product', 'finished_product_id', 'half_product_id')
            ->withPivot('int_lot', 'quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getExpiryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setExpiryDateAttribute($value)
    {
        $this->attributes['expiry_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function processing_spent()
    {
        return $this->belongsTo(ProductionSpent::class, 'processing_spent_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
