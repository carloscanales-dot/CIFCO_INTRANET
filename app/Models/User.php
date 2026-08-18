<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute; // Importar Attribute

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'area_id',
        'cargo_id',
        'sexo',
        'fecha_nacimiento',
        'telefono',
        'url_foto',
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
            'fecha_nacimiento' => 'date',
            'password' => 'hashed',
        ];
    }

    // Relaciones con catálogos
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    /**
     * Obtiene la URL de la foto de perfil formateada correctamente.
     *
     * Este accesor se encarga de limpiar la ruta guardada en la base de datos
     * para que solo devuelva el nombre del archivo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function urlFoto(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value) {
                    // 1. Reemplaza las barras invertidas de Windows por barras normales.
                    $path = str_replace('\\', '/', $value);
                    // 2. Devuelve solo el nombre del archivo.
                    return basename($path);
                }
                return null;
            },
        );
    }
}
