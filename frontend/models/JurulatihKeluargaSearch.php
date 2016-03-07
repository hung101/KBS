<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurulatihKeluarga;

/**
 * JurulatihKeluargaSearch represents the model behind the search form about `app\models\JurulatihKeluarga`.
 */
class JurulatihKeluargaSearch extends JurulatihKeluarga
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_keluarga_id', 'jurulatih_id'], 'integer'],
            [['nama_suami_isteri_waris', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'emel', 'no_telefon'], 'safe'],
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
        $query = JurulatihKeluarga::find();

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
            'jurulatih_keluarga_id' => $this->jurulatih_keluarga_id,
            'jurulatih_id' => $this->jurulatih_id,
        ]);

        $query->andFilterWhere(['like', 'nama_suami_isteri_waris', $this->nama_suami_isteri_waris])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_1', $this->alamat_surat_menyurat_1])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_2', $this->alamat_surat_menyurat_2])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_3', $this->alamat_surat_menyurat_3])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_negeri', $this->alamat_surat_menyurat_negeri])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_bandar', $this->alamat_surat_menyurat_bandar])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_poskod', $this->alamat_surat_menyurat_poskod])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon]);

        return $dataProvider;
    }
}
