<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UjianSaringan;

/**
 * UjianSaringanSearch represents the model behind the search form about `app\models\UjianSaringan`.
 */
class UjianSaringanSearch extends UjianSaringan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ujian_saringan_id'], 'integer'],
            [['nama', 'sekolah', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'jantina', 'no_telefon', 'darjah', 'catatan'], 'safe'],
            [['berat_badan', 'ketinggian', 'tinggi_duduk', 'panjang_depa', 'body_mass_index'], 'number'],
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
        $query = UjianSaringan::find()
                ->joinWith(['refSekolah'])
                ->joinWith(['refJantina']);

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
            'ujian_saringan_id' => $this->ujian_saringan_id,
            'berat_badan' => $this->berat_badan,
            'ketinggian' => $this->ketinggian,
            'tinggi_duduk' => $this->tinggi_duduk,
            'panjang_depa' => $this->panjang_depa,
            'body_mass_index' => $this->body_mass_index,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tbl_ref_sekolah.desc', $this->sekolah])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'darjah', $this->darjah])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
