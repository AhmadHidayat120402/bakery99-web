<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductBadge extends Model
{
    use HasFactory;

    protected $table = 'product_badges';

    protected $fillable = [
        'name',
        'icon',
        'bg_color',
        'text_color',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationship with Product model
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'product_badge_id');
    }
}
