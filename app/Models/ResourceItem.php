<?php

namespace App\Models;

use Database\Factories\ResourceItemFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function resourceAttachment()
    {
        return $this->hasOne(ResourceAttachment::class);
    }

    public function resourceDetail()
    {
        return $this->hasMany(ResourceDetail::class);
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
