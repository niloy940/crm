<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PdfInvoice extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use Auditable;
    use HasFactory;

    public const STATUS_SELECT = [
        'unpaid' => 'Neplaceno',
        'paid'   => 'Placeno',
    ];

    public const TYPE_SELECT = [
        'invoice'       => 'Faktura',
        'bill-delivery' => 'Racun-Otpremnica',
        'cash-bill'     => 'Gotovinski',
        'pro-forma'     => 'Predracun',
    ];

    public $table = 'pdf_invoices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'customer_id',
        'type',
        'status',
        'created_at',
        'discount',
        'pay_until',
        'note',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'customer_id');
    }

    public function products()
    {
        return $this->belongsToMany(ProductsList::class);
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
