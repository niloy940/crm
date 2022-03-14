<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionSpent extends Model
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

    public $table = 'production_spents';

    protected $dates = [
        'date_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'quantity',
        'shift',
        'date_time',
        'ingridients_id',
        'quantity_ing',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function products()
    {
        return $this->belongsToMany(ProductsList::class);
    }

    public function getDateTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateTimeAttribute($value)
    {
        $this->attributes['date_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function ingridients()
    {
        return $this->belongsTo(ProductsList::class, 'ingridients_id');
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
