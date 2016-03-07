<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPertukaranProgramPengajian;

/**
 * BspPertukaranProgramPengajianSearch represents the model behind the search form about `app\models\BspPertukaranProgramPengajian`.
 */
class BspPertukaranProgramPengajianSearch extends BspPertukaranProgramPengajian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_pertukaran_program_pengajian_id', 'bsp_pemohon_id', 'tempoh_perlanjutan_semester'], 'integer'],
            [['tarikh', 'bidang_pengajian_kursus', 'fakulti', 'tarikh_mula_pengajian', 'tarikh_tamat_pengajian'], 'safe'],
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
        $query = BspPertukaranProgramPengajian::find();

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
            'bsp_pertukaran_program_pengajian_id' => $this->bsp_pertukaran_program_pengajian_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'tarikh' => $this->tarikh,
            'tarikh_mula_pengajian' => $this->tarikh_mula_pengajian,
            'tarikh_tamat_pengajian' => $this->tarikh_tamat_pengajian,
            'tempoh_perlanjutan_semester' => $this->tempoh_perlanjutan_semester,
        ]);

        $query->andFilterWhere(['like', 'bidang_pengajian_kursus', $this->bidang_pengajian_kursus])
            ->andFilterWhere(['like', 'fakulti', $this->fakulti]);

        return $dataProvider;
    }
}
