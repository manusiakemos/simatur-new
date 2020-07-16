<?php
/**
 * Created by PhpStorm.
 * User: manusiakemos
 * Date: 16/07/20
 * Time: 09.47
 */

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class KelurahanTabalong implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        // TODO: Implement apply() method.
        $builder->join("tb_kecamatan", "tb_kelurahan.kecamatan_id", "tb_kecamatan.kecamatan_id")
            ->join("tb_kabupaten", "tb_kecamatan.kabupaten_id", "tb_kabupaten.kabupaten_id")
            ->where("tb_kabupaten.kabupaten_id", 6309);
    }
}
