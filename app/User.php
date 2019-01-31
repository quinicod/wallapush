<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Anuncio;
use App\Image;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'saldo', 'actived', 'password', 'localidad'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    { 
        parent::boot();
        static::deleting(function($usuario)
        { 
            if( ! App::runningInConsole() ){
                if($usuario->tieneAnuncio()->count()) { 
                    foreach($usuario->tieneAnuncio as $a) {
                        foreach($a->imagenes as $i) { 
                            if($i->img) { 
                                Storage::delete('anuncios/' . $i->img); 
                            } 
                        }
                        #   Borrar imagenes de los anuncios
                        $a->imagenes()->delete(); 
                        #   Borrar anuncios del usuario
                        $a->delete();
                    }
                }
            } 
        });
    }
    public function isAdmin(){
        if ($this->role=='admin') {
            return True;
        } else
            return False;
    }

    public function comprador() {
        return $this->belongsTo(Transaccion::class, 'id_comprador');
    }

    public function tieneAnuncio() {
        return $this->hasMany(Anuncio::class, 'id_vendedor');
    }
}
