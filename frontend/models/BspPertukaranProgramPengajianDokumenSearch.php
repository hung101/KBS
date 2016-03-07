<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPertukaranProgramPengajianDokumen;

/**
 * BspPertukaranProgramPengajianDokumenSearch represents the model behind the search form about `app\models\BspPertukaranProgramPengajianDokumen`.
 */
class BspPertukaranProgramPengajianDokumenSearch extends BspPertukaranProgramPengajianDokumen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_pertukaran_program_pengajian_dokumen_id', 'bsp_pertukaran_program_pengajian_id'], 'integer'],
            [['nama_dokumen', 'upload', 'session_id'], 'safe'],
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
        $query = BspPertukaranProgramPengajianDokumen::find();

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
            'bsp_pertukaran_program_pengajian_dokumen_id' => $this->bsp_pertukaran_program_pengajian_dokumen_id,
            'bsp_pertukaran_program_pengajian_id' => $this->bsp_pertukaran_program_pengajian_id,
        ]);

        $query->andFilterWhere(['like', 'nama_dokumen', $this->nama_dokumen])
            ->andFilterWhere(['like', 'upload', $this->upload])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
