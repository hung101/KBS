<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBantuanJawatankuasa;

/**
 * PermohonanEBantuanJawatankuasaSearch represents the model behind the search form about `app\models\PermohonanEBantuanJawatankuasa`.
 */
class PermohonanEBantuanJawatankuasaSearch extends PermohonanEBantuanJawatankuasa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jawatankuasa_id', 'permohonan_e_bantuan_id'], 'integer'],
            [['jawatan', 'nama', 'session_id'], 'safe'],
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
        $query = PermohonanEBantuanJawatankuasa::find()
                ->joinWith(['refJawatanEBantuan']);

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
            'jawatankuasa_id' => $this->jawatankuasa_id,
            'permohonan_e_bantuan_id' => $this->permohonan_e_bantuan_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jawatan_e_bantuan.desc', $this->jawatan])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
