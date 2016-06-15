<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanBimbinganKaunselingPegawaiAnggota;

/**
 * PermohonanBimbinganKaunselingPegawaiAnggotaSearch represents the model behind the search form about `app\models\PermohonanBimbinganKaunselingPegawaiAnggota`.
 */
class PermohonanBimbinganKaunselingPegawaiAnggotaSearch extends PermohonanBimbinganKaunselingPegawaiAnggota
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_bimbingan_kaunseling_pegawai_anggota_id', 'umur', 'bahagian', 'taraf_perkahwinan', 'status_jawatan', 'jantina', 'kategori_masalah', 'status_permohonan', 'umur_pegawai', 'bahagian_pegawai', 'taraf_perkahwinan_pegawai', 'status_jawatan_pegawai', 'jantina_pegawai', 'created_by', 'updated_by'], 'integer'],
            [['nama', 'jawatan', 'no_kad_pengenalan', 'no_telefon', 'emel', 'tarikh_temujanji', 'catatan_kaunselor', 'tindakan_kaunselor', 'cadangan_kaunselor', 'tarikh_permohonan', 'catatan_permohonan', 'nama_pegawai_anggota', 'no_kad_pengenalan_pegawai', 'jawatan_pegawai', 'no_tel_pegawai', 'emel_pegawai', 'created', 'updated'], 'safe'],
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
        $query = PermohonanBimbinganKaunselingPegawaiAnggota::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'permohonan_bimbingan_kaunseling_pegawai_anggota_id' => $this->permohonan_bimbingan_kaunseling_pegawai_anggota_id,
            'umur' => $this->umur,
            'bahagian' => $this->bahagian,
            'taraf_perkahwinan' => $this->taraf_perkahwinan,
            'status_jawatan' => $this->status_jawatan,
            'jantina' => $this->jantina,
            'tarikh_temujanji' => $this->tarikh_temujanji,
            'kategori_masalah' => $this->kategori_masalah,
            'tarikh_permohonan' => $this->tarikh_permohonan,
            'status_permohonan' => $this->status_permohonan,
            'umur_pegawai' => $this->umur_pegawai,
            'bahagian_pegawai' => $this->bahagian_pegawai,
            'taraf_perkahwinan_pegawai' => $this->taraf_perkahwinan_pegawai,
            'status_jawatan_pegawai' => $this->status_jawatan_pegawai,
            'jantina_pegawai' => $this->jantina_pegawai,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'catatan_kaunselor', $this->catatan_kaunselor])
            ->andFilterWhere(['like', 'tindakan_kaunselor', $this->tindakan_kaunselor])
            ->andFilterWhere(['like', 'cadangan_kaunselor', $this->cadangan_kaunselor])
            ->andFilterWhere(['like', 'catatan_permohonan', $this->catatan_permohonan])
            ->andFilterWhere(['like', 'nama_pegawai_anggota', $this->nama_pegawai_anggota])
            ->andFilterWhere(['like', 'no_kad_pengenalan_pegawai', $this->no_kad_pengenalan_pegawai])
            ->andFilterWhere(['like', 'jawatan_pegawai', $this->jawatan_pegawai])
            ->andFilterWhere(['like', 'no_tel_pegawai', $this->no_tel_pegawai])
            ->andFilterWhere(['like', 'emel_pegawai', $this->emel_pegawai]);

        return $dataProvider;
    }
}
