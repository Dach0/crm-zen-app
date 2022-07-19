<?php

namespace App\Models;

use Database\Factories\ResourceItemFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property int $resource_item_type_id
 * @property ResourceItemType $resourceType
 *
*/
class ResourceItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function resourceDetails(): HasMany
    {
        return $this->hasMany(ResourceDetail::class);
    }

    public function resourceType(): BelongsTo
    {
        return $this->belongsTo(ResourceItemType::class, 'resource_item_type_id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return ResourceItemFactory::new();
    }
}
