<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPenganjuranKejohananSirkitKewangan;

/**
 * BantuanPenganjuranKejohananSirkitKewanganSearch represents the model behind the search form about `app\models\BantuanPenganjuranKejohananSirkitKewangan`.
 */
class BantuanPenganjuranKejohananSirkitKewanganSearch extends BantuanPenganjuranKejohananSirkitKewangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_kewangan_id', 'bantuan_penganjuran_kejohanan_id', 'created_by', 'updated_by'], 'integer'],
            [['sumber_kewangan', 'lain_lain', 'session_id', 'created', 'updated'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = BantuanPenganjuranKejohananSirkitKewangan::find()
                ->joinWith(['refSumberKewanganBantuanPenganjuranKejohanan']);

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
            'bantuan_penganjuran_kejohanan_kewangan_id' => $this->bantuan_penganjuran_kejohanan_kewangan_id,
            'bantuan_penganjuran_kejohanan_id' => $this->bantuan_penganjuran_kejohanan_id,
            'jumlah' => $this->jumlah,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'sumber_kewangan', $this->sumber_kewangan])
            ->andFilterWhere(['like', 'lain_lain', $this->lain_lain])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
