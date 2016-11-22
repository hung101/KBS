<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MesyuaratSenaraiNamaHadir;

/**
 * MesyuaratSenaraiNamaHadirSearch represents the model behind the search form about `app\models\MesyuaratSenaraiNamaHadir`.
 */
class MesyuaratSenaraiNamaHadirSearch extends MesyuaratSenaraiNamaHadir
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senarai_nama_hadir_id', 'mesyuarat_id', 'kehadiran'], 'integer'],
            [['nama', 'session_id'], 'safe'],
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
        $query = MesyuaratSenaraiNamaHadir::find()
                ->joinWith(['refKelulusan']);

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
            'senarai_nama_hadir_id' => $this->senarai_nama_hadir_id,
            'tbl_mesyuarat_senarai_nama_hadir.mesyuarat_id' => $this->mesyuarat_id,
            'kehadiran' => $this->kehadiran,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
