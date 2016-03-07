<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KursusPersatuan;

/**
 * KursusPersatuanSearch represents the model behind the search form about `app\models\KursusPersatuan`.
 */
class KursusPersatuanSearch extends KursusPersatuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kursus_persatuan_id'], 'integer'],
            [['nama_kursus', 'tarikh', 'activiti', 'tempat', 'pegawai_terlibat'], 'safe'],
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
        $query = KursusPersatuan::find();

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
            'kursus_persatuan_id' => $this->kursus_persatuan_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'nama_kursus', $this->nama_kursus])
            ->andFilterWhere(['like', 'activiti', $this->activiti])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'pegawai_terlibat', $this->pegawai_terlibat]);

        return $dataProvider;
    }
}
