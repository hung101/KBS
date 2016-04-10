<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


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
            'nama_penganjur' => GeneralLabel::nama_penganjur,
            'nama_program' => GeneralLabel::nama_program,
            'negeri' => GeneralLabel::negeri,
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_pada' => GeneralLabel::tarikh_pada,
            'format' => GeneralLabel::format,

        ];
    }
}
