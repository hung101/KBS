<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPenganjuranKursusPegawaiTeknikalDisertai;

/**
 * BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch represents the model behind the search form about `app\models\BantuanPenganjuranKursusPegawaiTeknikalDisertai`.
 */
class BantuanPenganjuranKursusPegawaiTeknikalDisertaiSearch extends BantuanPenganjuranKursusPegawaiTeknikalDisertai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kursus_pegawai_teknikal_disertai_id', 'bantuan_penganjuran_kursus_pegawai_teknikal_id', 'created_by', 'updated_by'], 'integer'],
            [['kursus_seminar_bengkel', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'anjuran', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = BantuanPenganjuranKursusPegawaiTeknikalDisertai::find();

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
            'bantuan_penganjuran_kursus_pegawai_teknikal_disertai_id' => $this->bantuan_penganjuran_kursus_pegawai_teknikal_disertai_id,
            'bantuan_penganjuran_kursus_pegawai_teknikal_id' => $this->bantuan_penganjuran_kursus_pegawai_teknikal_id,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kursus_seminar_bengkel', $this->kursus_seminar_bengkel])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'anjuran', $this->anjuran])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
