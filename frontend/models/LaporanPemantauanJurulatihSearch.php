<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LaporanPemantauanJurulatih;
use app\models\Jurulatih;

/**
 * LaporanPemantauanJurulatihSearch represents the model behind the search form about `app\models\LaporanPemantauanJurulatih`.
 */
class LaporanPemantauanJurulatihSearch extends LaporanPemantauanJurulatih
{ 
    public $jurulatih_id_filter;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['laporan_pemantauan_jurulatih_id', 'jurulatih_id_filter'], 'integer'],
            [['jurulatih_id', 'sukan_id', 'program_id', 'pusat_latihan', 'tarikh_dinilai'], 'safe'],
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
        $query = LaporanPemantauanJurulatih::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refSukan'])
                ->joinWith(['refProgram']);

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
            'laporan_pemantauan_jurulatih_id' => $this->laporan_pemantauan_jurulatih_id,
            '{{tbl_laporan_pemantauan_jurulatih}}.jurulatih_id' => $this->jurulatih_id_filter,
        ]);
        
        $query->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->jurulatih_id])
              ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan_id])
              ->andFilterWhere(['like', 'tbl_ref_program_semasa_sukan_atlet.desc', $this->program_id])
              ->andFilterWhere(['like', '{{tbl_laporan_pemantauan_jurulatih}}.pusat_latihan', $this->pusat_latihan])
                ->andFilterWhere(['like', 'tarikh_dinilai', $this->tarikh_dinilai]);
            
        return $dataProvider;
    }
}
