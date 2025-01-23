<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelaksanaan_prodi extends Model
{
    use HasFactory;
    protected $table = 'pelaksanaan_prodi';

    // Pendefinisian primarykey secara khusus. Karena default laravel berupa 'id'
    protected $primaryKey = 'id_plks_prodi';

    /**
     * Atribut diisi secara massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_plks_prodi',
        'namafile',
        'nama_kategori',
        'nama_prodi',
        'files'
    ];
}
