<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspElaunLatihanPraktikal;

/**
 * BspElaunLatihanPraktikalSearch represents the model behind the search form about `app\models\BspElaunLatihanPraktikal`.
 */
class BspElaunLatihanPraktikalSearch extends BspElaunLatihanPraktikal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_elaun_latihan_praktikal_id', 'bsp_pemohon_id', 'jumlah_hari'], 'integer'],
            [['tarikh', 'jenis_latihan_amali', 'tempat_latihan_praktikal', 'tarikh_mula', 'tarikh_tamat'], 'safe'],
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
        $query = BspElaunLatihanPraktikal::find()
                ->joinWith(['refJenisLatihanAmali']);

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
            'bsp_elaun_latihan_praktikal_id' => $this->bsp_elaun_latihan_praktikal_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'tarikh' => $this->tarikh,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
            'jumlah_hari' => $this->jumlah_hari,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_latihan_amali.desc', $this->jenis_latihan_amali])
            ->andFilterWhere(['like', 'tempat_latihan_praktikal', $this->tempat_latihan_praktikal]);

        return $dataProvider;
    }
}
