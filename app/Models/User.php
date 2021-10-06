<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeSearch($query, array $params)
    {
        $query->where(function($query) use ($params) {
            $query->when($params['name'] ?? false, function($query, $name) {
                $filters = explode(' ', $name);
                $query->where('first_name','LIKE','%'.$filters[0].'%')
                    ->orWhere('last_name','LIKE','%'.$filters[1].'%');
            });
        })
        ->when($params['company'] ?? false, function($query, $company) {
            //$query->whereExists(function($query) use ($company) {
            //    $query->from('companies')
            //        ->whereColumn('companies.id','users.company_id')
            //        ->where('companies.name','LIKE',"%{$company}%");
            //});

            $query->whereHas('company', function($query) use ($company) {
                $query->where('companies.name','LIKE',"%{$company}%");
            });
        });
    }
}
