<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPendidikan;

/**
 * PermohonanPendidikanSearch represents the model behind the search form about `app\models\PermohonanPendidikan`.
 */
class PermohonanPendidikanSearch extends PermohonanPendidikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_pendidikan_id', 'umur', 'kelulusan'], 'integer'],
            [['no_ic', 'atlet_id', 'jantina', 'alamat_rumah_1', 'alamat_rumah_2', 'alamat_rumah_3', 'alamat_rumah_negeri', 'alamat_rumah_bandar', 'alamat_rumah_poskod', 'no_telefon_rumah', 'no_telefon_bimbit', 'nama_ibu_bapa_penjaga', 'tahap_pendidikan', 'aliran', 'keputusan_spm', 'pilihan_aliran_spm', 'sukan', 'acara', 'tahun_program', 'muat_naik', 'catatan', 'alamat_pendidikan_1', 'alamat_pendidikan_2', 'alamat_pendidikan_3', 'alamat_pendidikan_negeri', 'alamat_pendidikan_bandar', 'alamat_pendidikan_poskod', 'no_tel_pendidikan', 'no_fax_pendidikan', 'nama_pencadang', 'jawatan_pencadang', 'no_telefon_pencadang', 'sekolah_unit_sukan_pdd_psk_pencadang', 'nama_pengesahan', 'jawatan_pengesahan', 'no_telefon_pengesahan', 'sekolah_unit_sukan_pdd_psk_pengesahan'], 'safe'],
            [['tinggi', 'berat'], 'number'],
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
        $query = PermohonanPendidikan::find()
                ->joinWith(['refAtlet'])
                ->joinWith(['refTahapPendidikan']);

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
            'permohonan_pendidikan_id' => $this->permohonan_pendidikan_id,
            //'atlet_id' => $this->atlet_id,
            'umur' => $this->umur,
            'tinggi' => $this->tinggi,
            'berat' => $this->berat,
            'tahun_program' => $this->tahun_program,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'no_ic', $this->no_ic])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'alamat_rumah_1', $this->alamat_rumah_1])
            ->andFilterWhere(['like', 'alamat_rumah_2', $this->alamat_rumah_2])
            ->andFilterWhere(['like', 'alamat_rumah_3', $this->alamat_rumah_3])
            ->andFilterWhere(['like', 'alamat_rumah_negeri', $this->alamat_rumah_negeri])
            ->andFilterWhere(['like', 'alamat_rumah_bandar', $this->alamat_rumah_bandar])
            ->andFilterWhere(['like', 'alamat_rumah_poskod', $this->alamat_rumah_poskod])
            ->andFilterWhere(['like', 'no_telefon_rumah', $this->no_telefon_rumah])
            ->andFilterWhere(['like', 'no_telefon_bimbit', $this->no_telefon_bimbit])
            ->andFilterWhere(['like', 'nama_ibu_bapa_penjaga', $this->nama_ibu_bapa_penjaga])
            ->andFilterWhere(['like', 'tbl_ref_tahap_pendidikan.desc', $this->tahap_pendidikan])
            ->andFilterWhere(['like', 'aliran', $this->aliran])
            ->andFilterWhere(['like', 'keputusan_spm', $this->keputusan_spm])
            ->andFilterWhere(['like', 'pilihan_aliran_spm', $this->pilihan_aliran_spm])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'acara', $this->acara])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'alamat_pendidikan_1', $this->alamat_pendidikan_1])
            ->andFilterWhere(['like', 'alamat_pendidikan_2', $this->alamat_pendidikan_2])
            ->andFilterWhere(['like', 'alamat_pendidikan_3', $this->alamat_pendidikan_3])
            ->andFilterWhere(['like', 'alamat_pendidikan_negeri', $this->alamat_pendidikan_negeri])
            ->andFilterWhere(['like', 'alamat_pendidikan_bandar', $this->alamat_pendidikan_bandar])
            ->andFilterWhere(['like', 'alamat_pendidikan_poskod', $this->alamat_pendidikan_poskod])
            ->andFilterWhere(['like', 'no_tel_pendidikan', $this->no_tel_pendidikan])
            ->andFilterWhere(['like', 'no_fax_pendidikan', $this->no_fax_pendidikan])
            ->andFilterWhere(['like', 'nama_pencadang', $this->nama_pencadang])
            ->andFilterWhere(['like', 'jawatan_pencadang', $this->jawatan_pencadang])
            ->andFilterWhere(['like', 'no_telefon_pencadang', $this->no_telefon_pencadang])
            ->andFilterWhere(['like', 'sekolah_unit_sukan_pdd_psk_pencadang', $this->sekolah_unit_sukan_pdd_psk_pencadang])
            ->andFilterWhere(['like', 'nama_pengesahan', $this->nama_pengesahan])
            ->andFilterWhere(['like', 'jawatan_pengesahan', $this->jawatan_pengesahan])
            ->andFilterWhere(['like', 'no_telefon_pengesahan', $this->no_telefon_pengesahan])
            ->andFilterWhere(['like', 'sekolah_unit_sukan_pdd_psk_pengesahan', $this->sekolah_unit_sukan_pdd_psk_pengesahan]);

        return $dataProvider;
    }
}
