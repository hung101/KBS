<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPenganjuranKejohananSirkitOlehMsn;

/**
 * BantuanPenganjuranKejohananSirkitOlehMsnSearch represents the model behind the search form about `app\models\BantuanPenganjuranKejohananSirkitOlehMsn`.
 */
class BantuanPenganjuranKejohananSirkitOlehMsnSearch extends BantuanPenganjuranKejohananSirkitOlehMsn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_oleh_msn_id', 'bantuan_penganjuran_kejohanan_id', 'laporan_dikemukakan', 'created_by', 'updated_by'], 'integer'],
            [['kejohanan', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'peringkat_penganjuran', 'session_id', 'created', 'updated'], 'safe'],
            [['jumlah_bantuan'], 'number'],
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
        $query = BantuanPenganjuranKejohananSirkitOlehMsn::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bantuan_penganjuran_kejohanan_oleh_msn_id' => $this->bantuan_penganjuran_kejohanan_oleh_msn_id,
            'bantuan_penganjuran_kejohanan_id' => $this->bantuan_penganjuran_kejohanan_id,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
            'jumlah_bantuan' => $this->jumlah_bantuan,
            'laporan_dikemukakan' => $this->laporan_dikemukakan,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kejohanan', $this->kejohanan])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'peringkat_penganjuran', $this->peringkat_penganjuran])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
