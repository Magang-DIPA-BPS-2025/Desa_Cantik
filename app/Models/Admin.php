<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $fillable = ['name', 'username', 'password', 'role'];
    public $timestamps = true;

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
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        return isset($this->remember_token) ? $this->remember_token : null;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // Kolom remember_token tidak ada di tabel admins, jadi kita skip
        // Jika diperlukan di masa depan, tambahkan kolom ini ke migration
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Mutator untuk password - hanya hash jika belum di-hash
     */
    public function setPasswordAttribute($value)
    {
        if ($value && !empty($value)) {
            // Cek apakah password sudah di-hash (bcrypt hash selalu dimulai dengan $2y$)
            if (!preg_match('/^\$2[ayb]\$.{56}$/', $value)) {
                $this->attributes['password'] = bcrypt($value);
            } else {
                // Jika sudah di-hash, simpan langsung
                $this->attributes['password'] = $value;
            }
        }
    }
}
