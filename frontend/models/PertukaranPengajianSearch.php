<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PertukaranPengajian;

/**
 * PertukaranPengajianSearch represents the model behind the search form about `app\models\PertukaranPengajian`.
 */
class PertukaranPengajianSearch extends PertukaranPengajian
{
    public $atlet;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pertukaran_pengajian_id', 'atlet'], 'integer'],
            [['sebab_pemohonan', 'atlet_id', 'kategori_pengajian', 'nama_pengajian_sekarang', 'nama_pertukaran_pengajian', 'sebab_pertukaran', 
                'sebab_penangguhan', 'created', 'program', 'sukan', 'sebab', 'tarikh_permohonan'], 'safe'],
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
        $query = PertukaranPengajian::find()
                ->joinWith(['refPengajian'])
                ->joinWith(['refSebabPermohonanPertukaranPengajian'])
                ->joinWith(['refAtlet']);

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
            'pertukaran_pengajian_id' => $this->pertukaran_pengajian_id,
            //'atlet_id' => $this->atlet_id,
            'tbl_pertukaran_pengajian.atlet_id' => $this->atlet,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sebab_permohonan_pertukaran_pengajian.desc', $this->sebab_pemohonan])
            ->andFilterWhere(['like', 'kategori_pengajian', $this->kategori_pengajian])
            ->andFilterWhere(['like', 'nama_pengajian_sekarang', $this->nama_pengajian_sekarang])
            ->andFilterWhere(['like', 'tbl_ref_pengajian.desc', $this->nama_pertukaran_pengajian])
            ->andFilterWhere(['like', 'sebab_pertukaran', $this->sebab_pertukaran])
            ->andFilterWhere(['like', 'sebab_penangguhan', $this->sebab_penangguhan])
                ->andFilterWhere(['like', 'tbl_pertukaran_pengajian.created', $this->created])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
