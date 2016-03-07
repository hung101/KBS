<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdminEBiasiswa;

/**
 * AdminEBiasiswaSearch represents the model behind the search form about `app\models\AdminEBiasiswa`.
 */
class AdminEBiasiswaSearch extends AdminEBiasiswa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_e_biasiswa_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['nama', 'tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
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
        $query = AdminEBiasiswa::find();

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
            'admin_e_biasiswa_id' => $this->admin_e_biasiswa_id,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
            'aktif' => $this->aktif,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
