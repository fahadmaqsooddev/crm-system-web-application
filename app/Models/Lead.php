<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Lead extends Model
{
    use SoftDeletes,Notifiable,HasFactory;
    protected $fillable=['name','email','phone','status','assigned_to','notes'];

    public function user(){
        return $this->belongsTo(User::class,'assigned_to');
    }

    public function scopeSortable($query, $sort, $direction)
    {
        $allowedSorts = ['id', 'name', 'email', 'phone', 'status', 'assigned_to'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }
        if (!in_array($direction, $allowedDirections)) {
            $direction = 'asc';
        }

        if ($sort === 'assigned_to') {
            return $query->select('leads.*')
                         ->leftJoin('users', 'leads.assigned_to', '=', 'users.id')
                         ->orderBy('users.name', $direction);
        }
        return $query->orderBy($sort, $direction);
    }

    public static function countLeads()
    {
      $user = Auth::user();

        if ($user->isAdmin()) {
            return Lead::count();
        } elseif ($user->isAgent()) {
            return Lead::where('assigned_to', $user->id)->count();
        }

        return 0;
    }
}
