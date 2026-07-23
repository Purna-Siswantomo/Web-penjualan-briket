<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table('gallery')]
#[Fillable(['image_path', 'caption', 'order'])]
class GalleryPhoto extends Model
{
    /** @use HasFactory<\Database\Factories\GalleryPhotoFactory> */
    use HasFactory;
}
