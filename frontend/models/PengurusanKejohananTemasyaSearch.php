<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKejohananTemasya;

/**
 * PengurusanKejohananTemasyaSearch represents the model behind the search form about `app\models\PengurusanKejohananTemasya`.
 */
class PengurusanKejohananTemasyaSearch extends PengurusanKejohananTemasya
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kejohanan_temasya_id', 'pengurusan_kejohanan_temasya_main_id'], 'integer'],
            [['tarikh_kejohanan', 'session_id', 'nama_kejohanan_temasya', 'nama_sukan', 'nama_acara', 'lokasi_kejohanan', 'nama_ketua_kontijen', 'nama_atlet', 'nama_pegawai', 'nama_doktor', 'nama_fisio', 'tarikh_penginapan_mula', 'tarikh_penginapan_akhir', 'tarikh_perjalanan_pesawat', 'tarikh_pulang_perjalanan_pesawat', 'catatan_pesawat'], 'safe'],
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
        $query = PengurusanKejohananTemasya::find()
                ->joinWith(['refSukan'])
                ->joinWith(['refAcara']);

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
            'pengurusan_kejohanan_temasya_id' => $this->pengurusan_kejohanan_temasya_id,
            'pengurusan_kejohanan_temasya_main_id' => $this->pengurusan_kejohanan_temasya_main_id,
            'tarikh_kejohanan' => $this->tarikh_kejohanan,
            'tarikh_penginapan_mula' => $this->tarikh_penginapan_mula,
            'tarikh_penginapan_akhir' => $this->tarikh_penginapan_akhir,
            'tarikh_perjalanan_pesawat' => $this->tarikh_perjalanan_pesawat,
            'tarikh_pulang_perjalanan_pesawat' => $this->tarikh_pulang_perjalanan_pesawat,
        ]);

        $query->andFilterWhere(['like', 'nama_kejohanan_temasya', $this->nama_kejohanan_temasya])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_sukan])
            ->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->nama_acara])
            ->andFilterWhere(['like', 'lokasi_kejohanan', $this->lokasi_kejohanan])
            ->andFilterWhere(['like', 'nama_ketua_kontijen', $this->nama_ketua_kontijen])
            ->andFilterWhere(['like', 'nama_atlet', $this->nama_atlet])
            ->andFilterWhere(['like', 'nama_pegawai', $this->nama_pegawai])
            ->andFilterWhere(['like', 'nama_doktor', $this->nama_doktor])
            ->andFilterWhere(['like', 'nama_fisio', $this->nama_fisio])
            ->andFilterWhere(['like', 'catatan_pesawat', $this->catatan_pesawat])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
