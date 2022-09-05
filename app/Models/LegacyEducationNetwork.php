<?php

namespace App\Models;

use App\Models\Builders\LegacyEducationNetworkBuilder;
use App\Traits\Ativo;
use App\Traits\LegacyAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * LegacyEducationNetwork
 *
 * @method static LegacyEducationNetworkBuilder query()
 */
class LegacyEducationNetwork extends Model
{
    use LegacyAttribute;
    use Ativo;

    public const CREATED_AT = 'data_cadastro';
    public const UPDATED_AT = null;

    /**
     * @var string
     */
    protected $table = 'pmieducar.escola_rede_ensino';

    /**
     * @var string
     */
    protected $primaryKey = 'cod_escola_rede_ensino';

    /**
     * Builder dos filtros
     *
     * @var string
     */
    protected $builder = LegacyEducationNetworkBuilder::class;

    /**
     * Atributos legados para serem usados nas queries
     *
     * @var string[]
     */
    public $legacy = [
        'id' => 'cod_escola_rede_ensino',
        'name' => 'nm_rede'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'cod_escola_rede_ensino',
        'ref_usuario_cad',
        'ref_usuario_exc',
        'nm_rede',
        'data_cadastro',
        'ref_cod_instituicao',
    ];


    /**
     * @return string
     */
    public function getIdAttribute()
    {
        return $this->cod_escola_rede_ensino;
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->nm_rede;
    }
}
