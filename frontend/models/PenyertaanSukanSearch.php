<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenyertaanSukan;

/**
 * PenyertaanSukanSearch represents the model behind the search form about `app\models\PenyertaanSukan`.
 */
class PenyertaanSukanSearch extends PenyertaanSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_id'], 'integer'],
            [['nama_sukan', 'tempat_penginapan', 'tempat_latihan', 'nama_atlet', 'nama_pegawai', 'jawatan_pegawai', 'nama_pengurus_sukan', 'nama_sukarelawan'], 'safe'],
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
        $query = PenyertaanSukan::find()
                ->joinWith(['refSukan']);

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
            'penyertaan_sukan_id' => $this->penyertaan_sukan_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_sukan])
            ->andFilterWhere(['like', 'tempat_penginapan', $this->tempat_penginapan])
            ->andFilterWhere(['like', 'tempat_latihan', $this->tempat_latihan])
            ->andFilterWhere(['like', 'nama_atlet', $this->nama_atlet])
            ->andFilterWhere(['like', 'nama_pegawai', $this->nama_pegawai])
            ->andFilterWhere(['like', 'jawatan_pegawai', $this->jawatan_pegawai])
            ->andFilterWhere(['like', 'nama_pengurus_sukan', $this->nama_pengurus_sukan])
            ->andFilterWhere(['like', 'nama_sukarelawan', $this->nama_sukarelawan]);

        return $dataProvider;
    }
}
