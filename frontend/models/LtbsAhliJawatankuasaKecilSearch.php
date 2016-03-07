<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsAhliJawatankuasaKecil;

/**
 * LtbsAhliJawatankuasaKecilSearch represents the model behind the search form about `app\models\LtbsAhliJawatankuasaKecil`.
 */
class LtbsAhliJawatankuasaKecilSearch extends LtbsAhliJawatankuasaKecil
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ahli_jawatan_id', 'umur', 'profil_badan_sukan_id'], 'integer'],
            [['nama_jawatankuasa', 'jawatan', 'nama_penuh', 'no_kad_pengenalan', 'jantina', 'bangsa', 'no_tel', 'emel', 'pekerjaan', 'nama_majikan', 'tarikh_mula_memegang_jawatan', 'pengiktirafan_yang_diterima', 'kursus_yang_pernah_diikuti_oleh_pemegang_jawatan'], 'safe'],
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
        $query = LtbsAhliJawatankuasaKecil::find()
                ->joinWith(['refJawatan'])
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
            'ahli_jawatan_id' => $this->ahli_jawatan_id,
            'umur' => $this->umur,
            'tarikh_mula_memegang_jawatan' => $this->tarikh_mula_memegang_jawatan,
            'profil_badan_sukan_id' => $this->profil_badan_sukan_id,
        ]);

        $query->andFilterWhere(['like', 'nama_jawatankuasa', $this->nama_jawatankuasa])
            ->andFilterWhere(['like', 'tbl_ref_jawatan.desc', $this->jawatan])
            ->andFilterWhere(['like', 'nama_penuh', $this->nama_penuh])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
            ->andFilterWhere(['like', 'bangsa', $this->bangsa])
            ->andFilterWhere(['like', 'no_tel', $this->no_tel])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'nama_majikan', $this->nama_majikan])
            ->andFilterWhere(['like', 'pengiktirafan_yang_diterima', $this->pengiktirafan_yang_diterima])
            ->andFilterWhere(['like', 'kursus_yang_pernah_diikuti_oleh_pemegang_jawatan', $this->kursus_yang_pernah_diikuti_oleh_pemegang_jawatan]);
        
        // if login as persatuan, then filter only show that persatuan listing
        if(Yii::$app->user->identity->profil_badan_sukan){
            $query->andFilterWhere(['profil_badan_sukan_id' => Yii::$app->user->identity->profil_badan_sukan,]);
        }

        return $dataProvider;
    }
}
