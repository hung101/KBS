<?php

namespace app\models;

use Yii;
use yii\base\Model;


class ElaporanPelaksanaanReport extends Model
{

    public $nama_penganjur;
    public $nama_program;
    public $negeri;
    public $tarikh_dari;
    public $tarikh_pada;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
            [['nama_penganjur', 'nama_program', 'negeri', 'tarikh_dari', 'tarikh_pada'], 'safe'],
            [['tarikh_pada'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nama_penganjur' => 'Nama Penganjur',
            'nama_program' => 'Nama Program',
            'negeri' => 'Negeri',
            'tarikh_dari' => 'Tarikh Mula',
            'tarikh_pada' => 'Hingga',
            'format' => 'Format',
        ];
    }
}