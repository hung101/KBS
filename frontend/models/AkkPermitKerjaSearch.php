<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AkkPermitKerja;

/**
 * AkkPermitKerjaSearch represents the model behind the search form about `app\models\AkkPermitKerja`.
 */
class AkkPermitKerjaSearch extends AkkPermitKerja
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akk_permit_kerja_id', 'akademi_akk_id', 'created_by', 'updated_by'], 'integer'],
            [['no_permit', 'tahun', 'tarikh_tamat', 'permit', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = AkkPermitKerja::find();

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
            'akk_permit_kerja_id' => $this->akk_permit_kerja_id,
            'akademi_akk_id' => $this->akademi_akk_id,
            'tahun' => $this->tahun,
            'tarikh_tamat' => $this->tarikh_tamat,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'no_permit', $this->no_permit])
            ->andFilterWhere(['like', 'permit', $this->permit])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
