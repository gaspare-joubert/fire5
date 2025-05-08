<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Events\UserDeleted;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
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
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
        ];
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return (bool)$this->is_admin;
    }

    /**
     * Get the address associated with the user.
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * Get the contacts associated with the user.
     */
    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class)->withTimestamps();
    }

    /**
     * Get the files associated with the user.
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleting(function ($user) {
            // Log the deletion with user info and auth info
            Log::info('User deleted', [
                'deleted_user_id'    => $user->id ?? null,
                'deleted_user_email' => $user->email ?? null,
                'deleted_by_user_id' => auth()->id() ?? 'system',
                'deleted_by_ip'      => request()->ip() ?? null,
                'timestamp'          => now()->toIso8601String()
            ]);

            // 1. Handle physical file deletions
            // Database records will be deleted automatically via cascade
            $files = $user->files ?? [];
            foreach ($files as $file) {
                $diskName = 'secure';
                $fileName = $file->getAttribute('name');

                if (Storage::disk($diskName)->exists($fileName)) {
                    try {
                        Storage::disk($diskName)->delete($fileName);
                    } catch (\Throwable $e) {
                        Log::warning('File deletion failed: ', [
                            'file_path'    => $file->path ?? null,
                            'file_id'      => $file->id ?? null,
                            'user_id'      => $file->user_id ?? null,
                            'attempted_by' => auth()->id() ?? 'system'
                        ]);

                        Log::debug('File deletion info', [
                            'fileName' => $fileName,
                            'diskName' => $diskName,
                            'exists'   => 'yes',
                            'message'  => $e->getMessage()
                        ]);
                    }
                } else {
                    Log::warning('File deletion failed: file does not exist', [
                        'file_path'    => $file->path ?? null,
                        'file_id'      => $file->id ?? null,
                        'user_id'      => $file->user_id ?? null,
                        'attempted_by' => auth()->id() ?? 'system'
                    ]);
                }
            }

            // 2. Handle contacts that are only associated with this user
            $uniqueContacts = $user->contacts()->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('users.id', '!=', $user->id);
            })->get();

            // Delete contacts that were only connected to this user
            foreach ($uniqueContacts as $contact) {
                $contact->delete();
            }

            // 3. Fire a custom event for any other services that need to respond
            event(new UserDeleted($user));
        });
    }

}
