<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JO extends Model
{
    protected $table = 'joborder';
    protected $fillable = ['id','code_jo','jo','applydate','division','itemgroup_id','pimid','estdocm3','tuk','whgrade','whsimpan','whtahan', 'instruksilain','identitas', 'tebalfisik', 'lebarfisik', 'panjangfisik', 'descfisik','tebalbeli','lebarbeli','panjangbeli','descbeli','tebalinvoice','lebarinvoice','panjanginvoice','descinvoice','seratmiring','seratputus','bengkoklebar','bengkoktebal','gelombanglebar','gelombangtebal','twist','warnagelap','stain','taliair','busuk','pecahpermukaan','pecahujung','retak','matamati','kulittumbuh','pinholes','doreng','warnaterang','kayumuda','kukumacan','sisibaik','h2b','h2k','gubalsisiorder','gubalsisinonorder','cacatring','kualitas','is_delete'];

    // public function objectives()
    // {
    //     return $this->hasOne('App\Objective', 'id', 'objective');
    // }

    public function pims()
    {
        return $this->hasOne('App\PIM', 'id', 'pimid');
    }

    public function itemgroups()
    {
        return $this->hasOne('App\ItemGroup', 'id', 'itemgroup_id');
    }

    public function po()
    {
        return $this->hasOne('App\PO');
    }

}
