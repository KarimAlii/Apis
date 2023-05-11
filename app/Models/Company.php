<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name','industry','size','user_id'];

    /**
     * @var string[]
     */
    protected $casts = ['industry' => AsArrayObject::class];

    /**
     * @return HasOne
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }

    /**
     * @return HasOne
     */
    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
