<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'invoice_id',
        'shipping_address_id',
        'total_item',
        'total_item_price',
        'shipping_cost',
        'voucher_promo',
        'discount_amount',
        'total_amount',
        'order_date',
        'status',
    ];
    
    public function shippingAddress()
    {
        return $this->belongsTo(Shipping_address::class, 'shipping_address_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function ratingAndReviews()
    {
        return $this->hasMany(ratingAndReview::class);
    }


    // new update
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
