<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HptLaporanBulananPegawai;

/**
 * HptLaporanBulananPegawaiSearch represents the model behind the search form about `app\models\HptLaporanBulananPegawai`.
 */
class HptLaporanBulananPegawaiSearch extends HptLaporanBulananPegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hpt_laporan_bulanan_pegawai_id', 'created_by', 'updated_by'], 'integer'],
            [['nama_pegawai', 'bahagian_pusat_unit', 'tajuk_laporan', 'tarikh', 'perkara', 'catatan', 'muat_naik', 'created', 'updated'], 'safe'],
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
        $query = HptLaporanBulananPegawai::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'hpt_laporan_bulanan_pegawai_id' => $this->hpt_laporan_bulanan_pegawai_id,
            'tarikh' => $this->tarikh,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama_pegawai', $this->nama_pegawai])
            ->andFilterWhere(['like', 'bahagian_pusat_unit', $this->bahagian_pusat_unit])
            ->andFilterWhere(['like', 'tajuk_laporan', $this->tajuk_laporan])
            ->andFilterWhere(['like', 'perkara', $this->perkara])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik]);

        return $dataProvider;
    }
}
