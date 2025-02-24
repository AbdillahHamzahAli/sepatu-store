<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoeRating extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'rating',
        'comment',
        'shoe_id',
        'product_transaction_id',
    ];

    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }
    public function productTransaction()
    {
        return $this->belongsTo(ProductTransaction::class);
    }
}
