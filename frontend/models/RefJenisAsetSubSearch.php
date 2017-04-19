<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefJenisAsetSub;

/**
 * RefJenisAsetSubSearch represents the model behind the search form about `app\models\RefJenisAsetSub`.
 */
class RefJenisAsetSubSearch extends RefJenisAsetSub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ref_jenis_aset_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc', 'created', 'updated'], 'safe'],
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
        $query = RefJenisAsetSub::find()->joinWith(['refJenisAset']);

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
            'id' => $this->id,
            //'ref_jenis_aset_id' => $this->ref_jenis_aset_id,
            'aktif' => $this->aktif,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
			->andFilterWhere(['like', 'tbl_ref_jenis_aset.desc', $this->ref_jenis_aset_id]);

        return $dataProvider;
    }
}
