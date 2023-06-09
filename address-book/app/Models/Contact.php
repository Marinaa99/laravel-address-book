<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use League\CommonMark\Node\Block\Document;


class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id','last_name', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function  image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
