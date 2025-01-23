<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
   use HasFactory;

   protected $table = 'tabel_prodi';
   protected $primaryKey = 'id_prodi';

   /**
    * Atribut diisi secara massal
    *
    * @var array<int, string>
    */

   protected $fillable = [
      'id_prodi',
      'nama_prodi',
   ];

   public function pengendalians()
   {
      return $this->hasMany(Pengendalian::class, 'id_prodi');
   }
}
