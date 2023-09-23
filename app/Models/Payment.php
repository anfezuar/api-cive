<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo',
        'month',
        'year',
        'user',
        'status',
        'created_at',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehiculo');
    }

    /**
     * Scope a query to only include tickets of a given id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeId($query, $id)
    {
        if($id) return $query->where('id', $id);
    }

    /**
     * Scope a query to only include payments of a given user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUser($query, $user)
    {
        if($user) return $query->where('user', $user);
    }

    /**
     * Scope a query to only include payments of a given month.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $month
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMonth($query, $month)
    {
        if($month) return $query->where('month', $month);
    }

    /**
     * Scope a query to only include payments of a given year.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeYear($query, $year)
    {
        if($year) return $query->where('year', $year);
    }

    /**
     * Scope a query to only include payments of a given status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        if($status) return $query->where('status', $status);
    }

    /**
     * Scope a query to only include payments of a given created.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $created_ini
     * @param  mixed  $created_fin
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreated($query, $created_ini, $created_fin)
    {
        if($created_ini && $created_fin) return $query->whereBetween('created_at', [$created_ini.' 00:00:00', $created_fin.' 23:59:59']);
    }
}
