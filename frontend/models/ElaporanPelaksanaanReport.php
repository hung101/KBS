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
    public $e_laporan_kategori;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['nama_penganjur', 'nama_program', 'negeri', 'tarikh_dari', 'tarikh_pada', 'e_laporan_kategori'], 'safe'],
            [['tarikh_pada'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['nama_penganjur', 'nama_program', 'negeri'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
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
            'e_laporan_kategori' => GeneralLabel::kategori_elaporan,
        ];
    }
}
