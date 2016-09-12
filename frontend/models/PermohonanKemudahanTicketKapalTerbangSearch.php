<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanKemudahanTicketKapalTerbang;

/**
 * PermohonanKemudahanTicketKapalTerbangSearch represents the model behind the search form about `app\models\PermohonanKemudahanTicketKapalTerbang`.
 */
class PermohonanKemudahanTicketKapalTerbangSearch extends PermohonanKemudahanTicketKapalTerbang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_kemudahan_ticket_kapal_terbang_id', 'bil_penumpang', 'kelulusan'], 'integer'],
            [['nama_pemohon', 'bahagian', 'jawatan', 'destinasi', 'tarikh', 'nama_program', 'no_fail_kelulusan', 
                'aktiviti', 'kod_perbelanjaan', 'sukan', 'atlet', 'jurulatih', 'pegawai_teknikal', 'cawangan'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PermohonanKemudahanTicketKapalTerbang::find()
                ->joinWith(['program'])
                ->joinWith(['refBahagianKemudahan'])
                ->joinWith(['refCawanganKemudahan']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'permohonan_kemudahan_ticket_kapal_terbang_id' => $this->permohonan_kemudahan_ticket_kapal_terbang_id,
            'tarikh' => $this->tarikh,
            'bil_penumpang' => $this->bil_penumpang,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'nama_pemohon', $this->nama_pemohon])
            ->andFilterWhere(['like', 'tbl_ref_bahagian_kemudahan.desc', $this->bahagian])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'destinasi', $this->destinasi])
            ->andFilterWhere(['like', 'tbl_ref_program.desc', $this->nama_program])
            ->andFilterWhere(['like', 'no_fail_kelulusan', $this->no_fail_kelulusan])
            ->andFilterWhere(['like', 'aktiviti', $this->aktiviti])
            ->andFilterWhere(['like', 'kod_perbelanjaan', $this->kod_perbelanjaan])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'atlet', $this->atlet])
            ->andFilterWhere(['like', 'jurulatih', $this->jurulatih])
            ->andFilterWhere(['like', 'pegawai_teknikal', $this->pegawai_teknikal])
                ->andFilterWhere(['like', 'tbl_ref_cawangan_kemudahan.desc', $this->cawangan]);

        return $dataProvider;
    }
}
