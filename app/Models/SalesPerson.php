<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesperson extends Model
{
    use HasFactory;

   protected $table = "salespersons";

    protected $fillable = [
        'user_id',
        'name',
        'fg_color',
        'bg_color',
        'user_id',
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
