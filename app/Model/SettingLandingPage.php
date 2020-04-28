<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SettingLandingPage extends Model
{
    protected $table = 'setting_landing_page';
	// protected $fillable = array('*');
    protected $fillable = [
        'image_logo'
        , 'image_logo_compress' 
        , 'alamat' 
        , 'kota' 
        , 'kota_id' 
        , 'provinsi' 
        , 'provinsi_id' 
        , 'email' 
        , 'no_telp' 
        , 'deskripsi' 
        , 'facebook' 
        , 'instagram' 
        , 'twitter' 
        , 'google_plus' 
    ];
}
