<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaklumatPegawaiTeknikalKejohanan;

/**
 * MaklumatPegawaiTeknikalKejohananSearch represents the model behind the search form about `app\models\MaklumatPegawaiTeknikalKejohanan`.
 */
class MaklumatPegawaiTeknikalKejohananSearch extends MaklumatPegawaiTeknikalKejohanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id', 'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id', 'program', 'created_by', 'updated_by'], 'integer'],
            [['nama_kejohanan_kursus', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = MaklumatPegawaiTeknikalKejohanan::find();

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
            'bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id' => $this->bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id,
            'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id' => $this->bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
            'program' => $this->program,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama_kejohanan_kursus', $this->nama_kejohanan_kursus])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
