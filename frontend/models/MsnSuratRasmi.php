<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnSuratRasmi extends Model
{
    public $tarikh;
    public $nama_penerima;
    public $bil_msnm;
    public $jawatan;
    public $address_1;
    public $address_2;
	public $address_3;
    public $negeri;
	public $gelaran;

    public function rules()
    {
        return [
            [['nama_penerima', 'jawatan', 'address_1', 'negeri', 'tarikh', 'bil_msnm', 'gelaran'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['nama_penerima', 'jawatan', 'address_1', 'address_2', 'address_3', 'negeri', 'tarikh', 'bil_msnm', 'gelaran'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh' => GeneralLabel::tarikh,
            'bil_msnm' => "Bil MSNM",
            'nama_penerima' => GeneralLabel::nama,
			'jawatan' => GeneralLabel::jawatan,
            'address_1' => GeneralLabel::alamat_surat_menyurat_1,
			'address_2' => GeneralLabel::alamat_surat_menyurat_2,
			'address_3' => GeneralLabel::alamat_surat_menyurat_3,
            'negeri' => GeneralLabel::alamat_surat_menyurat_negeri,
			'gelaran' => GeneralLabel::gelaran,
        ];
    }
}
