<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    //
    use HasFactory, Notifiable;

    protected $fillable = ['title', 'description' , 'long_description'] ;

    public function toggleComplete(){
        $this->completed = ! $this->completed;
        $this->save();
    }
}


