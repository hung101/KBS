<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MesyuaratJkk;

/**
 * MesyuaratJkkSearch represents the model behind the search form about `app\models\MesyuaratJkk`.
 */
class MesyuaratJkkSearch extends MesyuaratJkk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mesyuarat_id'], 'integer'],
            [['nama_mesyuarat', 'bil_mesyuarat', 'tarikh', 'masa', 'tempat', 'pengurusi', 'pencatat_minit', 'perkara_perkara_dan_tindakan', 'mesyuarat_tamat',
                'mesyuarat_seterusnya', 'disedia_oleh', 'disemak_oleh', 'fasa', 'jenis_mesyuarat', 'sukan', 'program'], 'safe'],
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
        $query = MesyuaratJkk::find()
                ->joinWith(['refTempatJkk'])
                ->joinWith(['refFasa'])
                ->joinWith(['refBilJkk'])
                ->joinWith(['refJenisCawanganKuasaJkkJkp'])
                ->joinWith(['refSukan'])
                ->joinWith(['refProgramSemasaSukanAtlet']);

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
            'mesyuarat_id' => $this->mesyuarat_id,
            //'tarikh' => $this->tarikh,
            'masa' => $this->masa,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_tempat_jkk.desc', $this->tempat])
            ->andFilterWhere(['like', 'pengurusi', $this->pengurusi])
            ->andFilterWhere(['like', 'pencatat_minit', $this->pencatat_minit])
            ->andFilterWhere(['like', 'perkara_perkara_dan_tindakan', $this->perkara_perkara_dan_tindakan])
            ->andFilterWhere(['like', 'mesyuarat_tamat', $this->mesyuarat_tamat])
            ->andFilterWhere(['like', 'mesyuarat_seterusnya', $this->mesyuarat_seterusnya])
            ->andFilterWhere(['like', 'disedia_oleh', $this->disedia_oleh])
            ->andFilterWhere(['like', 'tarikh', $this->tarikh])
                ->andFilterWhere(['like', 'disemak_oleh', $this->disemak_oleh])
                ->andFilterWhere(['like', 'tbl_ref_fasa.desc', $this->fasa])
                ->andFilterWhere(['like', 'tbl_ref_bil_jkk.desc', $this->bil_mesyuarat])
                ->andFilterWhere(['like', 'tbl_ref_jenis_cawangan_kuasa_jkk_jkp.desc', $this->jenis_mesyuarat])
                ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
                ->andFilterWhere(['like', 'tbl_ref_program_semasa_sukan_atlet.desc', $this->program]);

        return $dataProvider;
    }
}
