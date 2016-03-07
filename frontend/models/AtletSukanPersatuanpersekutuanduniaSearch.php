<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletSukanPersatuanpersekutuandunia;

/**
 * AtletSukanPersatuanpersekutuanduniaSearch represents the model behind the search form about `app\models\AtletSukanPersatuanpersekutuandunia`.
 */
class AtletSukanPersatuanpersekutuanduniaSearch extends AtletSukanPersatuanpersekutuandunia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persatuan_persekutuan_dunia_id', 'atlet_id'], 'integer'],
            [['jenis', 'name_persatuan_persekutuan_dunia', 'alamat_1', 'no_telefon', 'emel', 'laman_web'], 'safe'],
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
        $query = AtletSukanPersatuanpersekutuandunia::find()
                ->joinWith(['refJenisSukanPersatuanPersekutuandunia'])
                ->joinWith(['refNamaSukanPersatuanPersekutuandunia']);

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
            'persatuan_persekutuan_dunia_id' => $this->persatuan_persekutuan_dunia_id,
            'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_sukan_persatuan_persekutuandunia.desc', $this->jenis])
            ->andFilterWhere(['like', 'tbl_ref_nama_sukan_persatuan_persekutuandunia.desc', $this->name_persatuan_persekutuan_dunia])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'laman_web', $this->laman_web]);

        return $dataProvider;
    }
}
