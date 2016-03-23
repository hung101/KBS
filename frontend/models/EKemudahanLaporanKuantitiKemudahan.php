<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;


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
            'negeri' => GeneralLabel::negeri,
            'kategori' => GeneralLabel::kategori,
            'format' => GeneralLabel::format,

        ];
    }
}
