<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Pantalla extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'pantallas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'cod_qr',
        'logo',
        'caracteristica_1',
        'caracteristica_2',
    ];

    protected $fillable = [
        'name_screen',
        'features',
        'url_tour',
        'brochure',
        'plants',
        'link_video',
        'mapa',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function screenClientes()
    {
        return $this->belongsToMany(Cliente::class);
    }

    public function getCodQrAttribute()
    {
        return $this->getMedia('cod_qr')->last();
    }

    public function id_gallery_1s()
    {
        return $this->belongsToMany(Galeriainterior::class);
    }

    public function id_gallery_2s()
    {
        return $this->belongsToMany(Espacioscomune::class);
    }

    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getCaracteristica1Attribute()
    {
        $file = $this->getMedia('caracteristica_1')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getCaracteristica2Attribute()
    {
        $file = $this->getMedia('caracteristica_2')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
