<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;

class Mesinro extends Model
{
    protected $table = 'mesinro';
    protected $fillable = ['tanggal','tandon', 'ph', 'feed', 'catridge', 'membran', 'permate', 'reject', 'catridge_status', 'catatan', 'username'];
    
    protected $casts = [
        'mesinro' => 'array'
    ];

    public function user()
    {
    	return $this->hasMany(User::class);
    }

    public $timestamps = false;
}
