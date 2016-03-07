<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TempahanKursusPersatuan;

/**
 * TempahanKursusPersatuanSearch represents the model behind the search form about `app\models\TempahanKursusPersatuan`.
 */
class TempahanKursusPersatuanSearch extends TempahanKursusPersatuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tempahan_kursus_persatuan_id', 'kursus_persatuan_id', 'unit_tempahan'], 'integer'],
            [['tarikh', 'jenis_tempahan', 'session_id'], 'safe'],
            [['kos_tempahan'], 'number'],
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
        $query = TempahanKursusPersatuan::find()
                ->joinWith(['refJenisTempahanKursusPersatuan']);

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
            'tempahan_kursus_persatuan_id' => $this->tempahan_kursus_persatuan_id,
            'kursus_persatuan_id' => $this->kursus_persatuan_id,
            'tarikh' => $this->tarikh,
            'unit_tempahan' => $this->unit_tempahan,
            'kos_tempahan' => $this->kos_tempahan,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_tempahan_kursus_persatuan.desc', $this->jenis_tempahan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
