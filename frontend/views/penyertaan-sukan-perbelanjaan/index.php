<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PenyertaanSukanPerbelanjaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::perbelanjaan_penyertaan_sukan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-perbelanjaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::tambah.' '.GeneralLabel::perbelanjaan_penyertaan_sukan, ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // [
                // 'attribute' => 'refKategoriPerbelanjaanSukan.desc',
                // 'filterInputOptions' => [
                    // 'class'       => 'form-control',
                    // 'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori,
                // ]
            // ],
            'refKategoriPerbelanjaanSukan.desc',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
