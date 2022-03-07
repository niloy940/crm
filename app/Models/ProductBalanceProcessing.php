<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBalanceProcessing extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'product_balance_processings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'halfproduct_id',
        'quantity',
        'balance_min_id',
        'balance_optimal_id',
        'balance_max',
        'balance_reserved',
        'team_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function halfproduct()
    {
        return $this->belongsTo(HalfProductMake::class, 'halfproduct_id');
    }

    public function balance_min()
    {
        return $this->belongsTo(ProductsList::class, 'balance_min_id');
    }

    public function balance_optimal()
    {
        return $this->belongsTo(ProductsList::class, 'balance_optimal_id');
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
