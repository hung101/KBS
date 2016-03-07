<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPrestasiAkademik;

/**
 * BspPrestasiAkademikSearch represents the model behind the search form about `app\models\BspPrestasiAkademik`.
 */
class BspPrestasiAkademikSearch extends BspPrestasiAkademik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_prestasi_akademik_id', 'bsp_pemohon_id', 'bsp_borang_borang_id'], 'integer'],
            [['tarikh', 'png', 'pngk', 'session_id', 'semester'], 'safe'],
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
        $query = BspPrestasiAkademik::find()
                ->joinWith(['refSemesterTerkini']);

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
            'bsp_prestasi_akademik_id' => $this->bsp_prestasi_akademik_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'tarikh' => $this->tarikh,
            'bsp_borang_borang_id' => $this->bsp_borang_borang_id,
        ]);

        $query->andFilterWhere(['like', 'png', $this->png])
            ->andFilterWhere(['like', 'pngk', $this->pngk])
                ->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_ref_semester_terkini.desc', $this->semester]);

        return $dataProvider;
    }
}
