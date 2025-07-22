<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $primaryKey = 'id';
    protected $table = 'users';

    protected $fillable = [
        'name',
        'alamat',
        'tgl_lahir',
        'email',
        'password',
        'role',
        'google_id',
        'foto_profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function scopeFilter(Builder $query, $request, array $filterableColumns, array $searchableColumns): Builder
        {
            foreach ($filterableColumns as $column) {
                if ($request->filled($column)) {
                    $query->where($column, $request->input($column));
                }
            }
            if ($request->filled('search')) {
                $query->where(function ($q) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $q->orWhere($column, 'LIKE', '%' . $request->input('search') . '%');
                    }
                });
            }
            return $query;
        }
}
