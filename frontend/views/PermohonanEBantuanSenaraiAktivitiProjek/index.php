<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PermohonanEBantuanSenaraiAktivitiProjekSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Aktiviti / Projek Yang Dijalankan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-senarai-aktiviti-projek-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Senarai Aktiviti / Projek Yang Dijalankan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'senarai_aktiviti_projek_id',
            //'permohonan_e_bantuan_id',
            'nama_aktiviti_projek',
            'keterangan_ringkas',
            'kejayaan_yang_dicapai',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
