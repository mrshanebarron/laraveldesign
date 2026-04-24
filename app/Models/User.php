<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Authenticated admin user for the LaravelDesign demo app.
 *
 * Implements Filament\Models\Contracts\FilamentUser so that Filament's
 * production-mode guard allows access to /admin. In non-local environments
 * Filament requires an explicit canAccessPanel() decision; without it every
 * logged-in user receives 403 at the panel root.
 */
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * Authorize the user to access a Filament panel.
     *
     * Called by Filament on every request to a panel route. Returning true
     * opens the admin panel to every authenticated user — appropriate for
     * this demo where seeded admins are the only users. A production install
     * should tighten this (role check, email domain allow-list, etc.).
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
