<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProfilKonsultanKontrakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profil Konsultan Kontraks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-konsultan-kontrak-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Profil Konsultan Kontrak', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'profil_konsultan_kontrak_id',
            'profil_konsultan_id',
            'tarikh_kontrak_mula',
            'tarikh_kontrak_akhir',
            'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
