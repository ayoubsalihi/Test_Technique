<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'amount',
        'currency',
        'spent_at',
        'category',
        'receipt_path',
        'status',
    ];

    protected $casts = [
        'spent_at' => 'date',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logs()
    {
        return $this->hasMany(ExpenseLog::class);
    }


    /**
     * des methodes en query builder bien optimisee
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByCategory($query, $category)
    {
        return $category ? $query->where('category', $category) : $query;
    }

    public function scopeByStatus($query, $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeByPeriod($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            return $query->whereBetween('spent_at', [$startDate, $endDate]);
        }
        return $query;
    }
}
