<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenganjuranKursusPesertaSukan;

/**
 * PenganjuranKursusPesertaSukanSearch represents the model behind the search form about `app\models\PenganjuranKursusPesertaSukan`.
 */
class PenganjuranKursusPesertaSukanSearch extends PenganjuranKursusPesertaSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penganjuran_kursus_peserta_sukan_id', 'penganjuran_kursus_peserta_id', 'created_by', 'updated_by'], 'integer'],
            [['tahun', 'jenis_sukan', 'tahap', 'created', 'updated', 'session_id'], 'safe'],
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
        $query = PenganjuranKursusPesertaSukan::find()
                ->joinWith(['refSukan'])
                ->joinWith(['refTahapSukanPeserta']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'penganjuran_kursus_peserta_sukan_id' => $this->penganjuran_kursus_peserta_sukan_id,
            'penganjuran_kursus_peserta_id' => $this->penganjuran_kursus_peserta_id,
            //'jenis_sukan' => $this->jenis_sukan,
            //'tahap' => $this->tahap,
            'tahun' => $this->tahun,
            'session_id' => $this->session_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);
        
        $query->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->jenis_sukan])
            ->andFilterWhere(['like', 'tbl_ref_tahap_sukan_peserta.desc', $this->tahap]);

        return $dataProvider;
    }
}
