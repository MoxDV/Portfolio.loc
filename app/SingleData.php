<?php

namespace Portfolio;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SingleData
 * @package Portfolio
 *
 * Модель содержит единичные данные в БД.
 *
 * @author Моксин Дмитрий Владимирович <moxdv777@mail.ru>
 * @version 1.0.0
 */
class SingleData extends Model {
    protected $table = 'single_datas';
    protected $fillable = ['data', 'identifier'];
    protected $casts = [ 'data' => 'array', ];

    /**
     * Возвращает массив данных по идентификатору.
     *
     * @param string $identifier Задает идентификатор.
     * @return array Возвращает данные по идентификатору.
     */
    public static function getData(string $identifier){
        $data = SingleData::where('identifier', $identifier)->first();
        if($data) return $data->data;
        return [];
    }

    /**
     * Обновляет данные по идентификатору.
     *
     * @param string $identifier Задает идентификатор.
     * @param array $data Задает данные которые необходимо сохранить.
     * @return Model Возвращает единичные данные под указанным индексом.
     */
    public static function setData(string $identifier, array $data){
        return SingleData::updateOrCreate(
            ['identifier'    => $identifier],
            ['data'          => $data]);
    }
}
