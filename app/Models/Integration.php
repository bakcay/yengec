<?php

namespace App\Models;

use App\Enums\Marketplace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $marketplace
 * @property string|null $username
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Integration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Integration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Integration query()
 * @method static \Illuminate\Database\Eloquent\Builder|Integration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Integration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Integration whereMarketplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Integration wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Integration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Integration whereUsername($value)
 * @mixin \Eloquent
 */
class Integration extends Model
{
    use HasFactory;

    protected $fillable = ['marketplace', 'username', 'password'];

    public function getMarketplaceAttribute($value) {
        return Marketplace::tryFrom($value);
    }

    public function setMarketplaceAttribute($value) {
        $this->attributes['marketplace'] = $value instanceof Marketplace ? $value->value : $value;
    }
}
