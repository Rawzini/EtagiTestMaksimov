<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const CREATED_AT = 'dateOfCreation';
    const UPDATED_AT = 'updateDate';

    protected $fillable = [
        'title',
        'description',
        'expirationDate',
        'dateOfCreation',
        'updateDate',
        'priority',
        'status',
        'creator_id',
        'responsible_id',
    ];

    protected $casts = [
        'expirationDate' => 'datetime',
        'dateOfCreation' => 'datetime',
        'updateDate' => 'datetime',
    ];

    //protected $dateFormat = 'd-m-Y H:i:s';

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    public function responsible()
    {
        return $this->belongsTo('App\Models\User', 'responsible_id');
    }
}
