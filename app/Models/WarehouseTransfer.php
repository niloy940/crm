<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseTransfer extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'warehouse_transfers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'warehouse_from_id',
        'warehouse_to_id',
        'product_id',
        'int_lot_id',
        'quantity',
        'user_id',
        'user_received_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function warehouse_from()
    {
        return $this->belongsTo(WarehousesList::class, 'warehouse_from_id');
    }

    public function warehouse_to()
    {
        return $this->belongsTo(WarehousesList::class, 'warehouse_to_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductsList::class, 'product_id');
    }

    public function int_lot()
    {
        return $this->belongsTo(ReceiptNote::class, 'int_lot_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user_received()
    {
        return $this->belongsTo(User::class, 'user_received_id');
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
