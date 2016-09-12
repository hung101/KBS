<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPenganjuranKejohananElemen;

/**
 * BantuanPenganjuranKejohananElemenSearch represents the model behind the search form about `app\models\BantuanPenganjuranKejohananElemen`.
 */
class BantuanPenganjuranKejohananElemenSearch extends BantuanPenganjuranKejohananElemen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_elemen_id', 'bantuan_penganjuran_kejohanan_id', 'bilangan', 'hari', 'created_by', 'updated_by'], 'integer'],
            [['elemen_bantuan', 'sub_elemen', 'session_id', 'created', 'updated'], 'safe'],
            [['kadar', 'jumlah'], 'number'],
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
        $query = BantuanPenganjuranKejohananElemen::find()
                ->joinWith(['refElemenBantuanPenganjuranKejohanan'])
                ->joinWith(['refSubElemenBantuanPenganjuranKejohanan']);

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
            'bantuan_penganjuran_kejohanan_elemen_id' => $this->bantuan_penganjuran_kejohanan_elemen_id,
            'bantuan_penganjuran_kejohanan_id' => $this->bantuan_penganjuran_kejohanan_id,
            'kadar' => $this->kadar,
            'bilangan' => $this->bilangan,
            'hari' => $this->hari,
            'jumlah' => $this->jumlah,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'elemen_bantuan', $this->elemen_bantuan])
            ->andFilterWhere(['like', 'sub_elemen', $this->sub_elemen])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
