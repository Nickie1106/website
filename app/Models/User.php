<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'phone_number', 'email', 'password', 'member_number',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 現在借りている本（返却されていない本）を取得
    public function borrowedBooks()
    {
        return $this->belongsToMany(Book::class, 'borrow_records')
                    ->withPivot('borrowed_at', 'due_date', 'returned_at')
                    ->whereNull('borrow_records.returned_at');
    }

    // 過去に借りた本（返却された本）を取得
    public function pastBorrowings()
    {
        return $this->belongsToMany(Book::class, 'borrow_records')
                    ->withPivot('borrowed_at', 'due_date', 'returned_at')
                    ->whereNotNull('borrow_records.returned_at');  // 返却された本を取得
    }
}
