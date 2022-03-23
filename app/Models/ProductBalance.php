<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBalance extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'product_balances';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'quantity',
        'team_id',
        'balance_optimal_id',
        'balance_min_id',
        'balance_max',
        'balance_reserved',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function productLists()
    {
        return $this->belongsToMany(ProductsList::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function balance_optimal()
    {
        return $this->belongsTo(ProductsList::class, 'balance_optimal_id');
    }

    public function balance_min()
    {
        return $this->belongsTo(ProductsList::class, 'balance_min_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
