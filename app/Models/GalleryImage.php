<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'gallery_images';

    // Specify the fillable attributes
    protected $fillable = [
        'image_path',  // Path to the image file
        'destination',  // Destination related to the image
    ];

    // Timestamps are automatically managed by Eloquent
}
