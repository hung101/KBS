<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefCawanganUser;

/**
 * RefCawanganUserSearch represents the model behind the search form about `app\models\RefCawanganUser`.
 */
class RefCawanganUserSearch extends RefCawanganUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktif', 'cacat', 'created_by', 'updated_by'], 'integer'],
            [['desc', 'created', 'updated','ref_bahagian_user_id', 'ref_jabatan_user_id'], 'safe'],
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
        $query = RefCawanganUser::find()
                ->joinWith('refBahagianUser')
                ->joinWith('refJabatanUser');

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
            'id' => $this->id,
            //'ref_jabatan_user_id' => $this->ref_jabatan_user_id,
            'aktif' => $this->aktif,
            'cacat' => $this->cacat,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
                ->andFilterWhere(['like', 'tbl_ref_bahagian_user.desc', $this->ref_bahagian_user_id])
                ->andFilterWhere(['like', 'tbl_ref_jabatan_user.desc', $this->ref_jabatan_user_id]);

        return $dataProvider;
    }
}
