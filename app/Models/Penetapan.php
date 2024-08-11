<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penetapan extends Model
{
    use HasFactory;

    protected $table = 'penetapans';
     /**
     * Atribut diisi secara massal
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_penetapan',
        'level_penetapan',
        'namaDokumen_penetapan',
        'files'
    ];

    /**
     * Jika Penetapan berupa level perangkatspmi.
     *
     * @return bool
     */
    public function isPerangkatspmi()
    {
        return $this->level_penetapan === 'perangkatspmi';
    }

    /**
     * Jika Penetapan berupa level standarinstitusi.
     *
     * @return bool
     */
    public function isStandarinstitusi()
    {
        return $this->level_penetapan === 'standarinstitusi';
    }
}
