<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanProgramPersatuan;

/**
 * PengurusanProgramPersatuanSearch represents the model behind the search form about `app\models\PengurusanProgramPersatuan`.
 */
class PengurusanProgramPersatuanSearch extends PengurusanProgramPersatuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_program_persatuan'], 'integer'],
            [['bantuan_tahun', 'nama_persatuan'], 'safe'],
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
        $query = PengurusanProgramPersatuan::find();

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
            'pengurusan_program_persatuan' => $this->pengurusan_program_persatuan,
            'bantuan_tahun' => $this->bantuan_tahun,
        ]);

        $query->andFilterWhere(['like', 'nama_persatuan', $this->nama_persatuan]);

        return $dataProvider;
    }
}
