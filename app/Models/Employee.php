<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'hired_at',
        'position',
        'department_id',
        'phone',
        'salary',
        'avatar'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getAvatarAttribute($value)
    {
        if ($value) {
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk = Storage::disk('minio');
            return $disk->temporaryUrl($value, now()->addMinutes(10));
        }
        return null;
    }

    public function setAvatarAttribute($file)
    {
        if (request()->hasFile('avatar')) {
            // Delete the old avatar if it exists
            if ($this->attributes['avatar'] ?? false) {
                Storage::disk('minio')->delete($this->attributes['avatar']);
            }

            // Store the new file and set the path
            $path = $file->store('employees', 'minio');
            $this->attributes['avatar'] = $path;
        }
    }
}
