<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

use app\models\RefStatusTemujanjiFisioterapi;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlTemujanjiFisioterapiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::jadual_pegawai;
?>
<div class="pl-temujanji-fisioterapi-index">
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'pl_temujanji_id',
            //'atlet_id',
            //'tarikh_temujanji',
            [
                'attribute' => 'tarikh_temujanji',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_temujanji,
                ],
                'format' => 'raw',
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_temujanji, GeneralFunction::TYPE_DATETIME);
                },
            ],
            [
                'attribute' => 'kategori_rawatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::kategori_rawatan,
                ],
                'value' => 'refKategoriRawatan.desc'
            ],
            [
                'attribute' => 'nama_pesakit_luar',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_pesakit_luar,
                ],
            ],
            [
                'attribute' => 'no_kad_pengenalan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_kad_pengenalan,
                ],
            ],           
            //'doktor_pegawai_perubatan',
            //'makmal_perubatan',
            //'status_temujanji',
            [
                'attribute' => 'nama_fisioterapi',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_fisioterapi,
                ],
                'value' => 'refNamaFisioterapi.desc'
            ],
            [
                'attribute' => 'status_temujanji',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_temujanji,
                ],
                'value' => 'refStatusTemujanjiPesakitLuar.desc',
                'filter' => Html::activeDropDownList($searchModel, 'status_temujanji', ArrayHelper::map(RefStatusTemujanjiFisioterapi::find()->asArray()->all(), 'id', 'desc'),['class'=>'form-control','prompt' => 'Select Category']),
            ],
            // 'pegawai_yang_bertanggungjawab',
            // 'catitan_ringkas',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
