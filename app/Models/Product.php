<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_category_id',
        'product_badge_id',
        'name',
        'slug',
        'image',
        'price',
        'unit',
        'description',
        'is_best_seller',
        'is_popular',
        'is_active',
        'sort_order',
        'featured_sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_best_seller' => 'boolean',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Relationship with ProductCategory model
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /**
     * Relationship with ProductBadge model
     */
    public function badge(): BelongsTo
    {
        return $this->belongsTo(ProductBadge::class, 'product_badge_id');
    }
}
