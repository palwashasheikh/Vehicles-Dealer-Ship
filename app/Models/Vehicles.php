<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

   protected $table = "Vehicles";

    protected $fillable = [
        'user_id',
        'fg_color',
        'bg_color',
        'trim',
        'year',
        'make',
        'model',
        'status'
    ];

    // Relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to the Dealership model
    public function dealership()
    {
        return $this->belongsTo(Dealership::class);
    }
}
