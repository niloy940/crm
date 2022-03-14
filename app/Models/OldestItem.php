<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OldestItem extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public $table = 'oldest_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_id',
        'created_at',
        'quantity_id',
        'int_lot_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function product()
    {
        return $this->belongsTo(ProductsList::class, 'product_id');
    }

    public function expiry_dates()
    {
        return $this->belongsToMany(ReceiptNote::class);
    }

    public function quantity()
    {
        return $this->belongsTo(ReceiptNote::class, 'quantity_id');
    }

    public function int_lot()
    {
        return $this->belongsTo(ReceiptNote::class, 'int_lot_id');
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
