<?php

namespace app\models;

use Yii;
use yii\base\Model;


class EKemudahanLaporanKuantitiKemudahan extends Model
{
    public $negeri;
    public $kategori;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
            [['negeri', 'kategori'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'negeri' => 'Negeri',
            'kategori' => 'Kategori',
            'format' => 'Format',
        ];
    }
}
