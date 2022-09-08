<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Game
 * @package App\Models
 * @property int admin_id
 * @property string title
 * @property string image
 */
class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'admin_id'
    ];
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
