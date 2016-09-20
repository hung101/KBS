<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenilaianPrestasiAtletSasaran;

/**
 * PenilaianPrestasiAtletSasaranSearch represents the model behind the search form about `app\models\PenilaianPrestasiAtletSasaran`.
 */
class PenilaianPrestasiAtletSasaranSearch extends PenilaianPrestasiAtletSasaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penilaian_prestasi_atlet_sasaran_id', 'penilaian_pestasi_id', 'created_by', 'updated_by'], 'integer'],
            [['sasaran', 'session_id', 'created', 'updated', 'atlet', 'keputusan'], 'safe'],
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
        $query = PenilaianPrestasiAtletSasaran::find()
                ->joinWith(['refAtlet'])
                ->joinWith(['refKeputusan']);

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
            'penilaian_prestasi_atlet_sasaran_id' => $this->penilaian_prestasi_atlet_sasaran_id,
            'penilaian_pestasi_id' => $this->penilaian_pestasi_id,
            //'atlet' => $this->atlet,
            //'keputusan' => $this->keputusan,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'sasaran', $this->sasaran])
            ->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet])
                ->andFilterWhere(['like', 'tbl_ref_keputusan.desc', $this->keputusan]);

        return $dataProvider;
    }
}
