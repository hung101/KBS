<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BorangAduanKerosakan;

/**
 * BorangAduanKerosakanSearch represents the model behind the search form about `app\models\BorangAduanKerosakan`.
 */
class BorangAduanKerosakanSearch extends BorangAduanKerosakan
{
    public $penyelia_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borang_aduan_kerosakan_id', 'created_by', 'updated_by', 'penyelia_id'], 'integer'],
            [['jawatan', 'tarikh', 'no_tel_pejabat', 'no_tel_bimbit', 'kawasan', 'penyelia', 'venue', 'bahagian', 'created', 'updated'], 'safe'],
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
        $query = BorangAduanKerosakan::find()
                ->joinWith(['refPengurusanPenyelia'])
                ->joinWith(['refVenueAduan'])
                ->joinWith(['refKawasanKemudahan']);

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
            'borang_aduan_kerosakan_id' => $this->borang_aduan_kerosakan_id,
            //'penyelia' => $this->penyelia,
            //'tarikh' => $this->tarikh,
            //'venue' => $this->venue,
            //'bahagian' => $this->bahagian,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
            'penyelia' => $this->penyelia_id,
        ]);

        $query->andFilterWhere(['like', 'jawatan', $this->jawatan])
                ->andFilterWhere(['like', 'tarikh', $this->tarikh])
                ->andFilterWhere(['like', 'tbl_user.full_name', $this->penyelia])
                ->andFilterWhere(['like', 'tbl_ref_venue_aduan.desc', $this->venue])
            ->andFilterWhere(['like', 'no_tel_pejabat', $this->no_tel_pejabat])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'tbl_ref_kawasan_kemudahan.desc', $this->kawasan]);

        return $dataProvider;
    }
}
