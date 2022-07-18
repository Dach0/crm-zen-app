<?php

namespace App\Models;

use Database\Factories\ResourceAttachmentFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceAttachment extends Model
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return ResourceAttachmentFactory::new();
    }
}
