<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSpreadsheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_spreadsheet',
        'id_ticket'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_ticket');
    }
}
