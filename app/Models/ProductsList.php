<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsList extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const MEASURE_SELECT = [
        'pc' => 'Kom.',
        'kg' => 'Kilogram',
        'g'  => 'Gram',
        'l'  => 'Litar',
        'm2' => 'Metar2',
    ];

    public $table = 'products_lists';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'warehouse_id',
        'price',
        'measure',
        'balance_optimal',
        'balance_min',
        'balance_max',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function warehouse()
    {
        return $this->belongsTo(WarehousesList::class, 'warehouse_id');
    }

    public function int_lots()
    {
        return $this->belongsToMany(ReceiptNote::class);
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
