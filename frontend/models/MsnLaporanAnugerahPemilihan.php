<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanAnugerahPemilihan extends Model
{
    public $pemilihan_id;
    public $tahun;
    public $format;
    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            // [['tarikh_dari', 'tarikh_hingga', 'program', 'sukan', 'negeri', 'acara', 'kategori_kecacatan', 'atlet', 'source', 'jenis', 'kod_kursus', 'kejohanan', 'temasya'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            // 'tarikh_dari' => GeneralLabel::tarikh_dari,
            // 'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            // 'program' => GeneralLabel::program,
            // 'sukan' => GeneralLabel::sukan,
            // 'negeri' => GeneralLabel::negeri,
            // 'acara' => GeneralLabel::acara,
            // 'atlet' => GeneralLabel::atlet,
            // 'source' => GeneralLabel::source,
            // 'kod_kursus' => GeneralLabel::kod_kursus,
            // 'format' => GeneralLabel::format,
            // 'kejohanan' => GeneralLabel::kejohanan,
            // 'temasya' => GeneralLabel::temasya,
            // 'kategori_kecacatan' => GeneralLabel::kategori_kecacatan,
        ];
    }
}
