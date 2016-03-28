<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AkkPermitKerjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akk Permit Kerjas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-permit-kerja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Akk Permit Kerja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'akk_permit_kerja_id',
            'akademi_akk_id',
            'no_permit',
            'tahun',
            'tarikh_tamat',
            // 'permit',
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
