<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AkkProgramJurulatihPesertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::maklumat_peribadi_peserta_jurulatih_msn;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-program-jurulatih-peserta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::peningkatan_kerjaya_jurulatih, ['create'], ['class' => 'btn btn-success']); ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'akk_program_jurulatih_peserta_id',
            //'akk_program_jurulatih_id',
            [
                'attribute' => 'jurulatih',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::jurulatih,
                ],
                'value' => 'refJurulatih.nama'
            ],
            [
                'attribute' => 'sukan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::sukan,
                ],
                'value' => 'refSukan.desc'
            ],
            [
                'attribute' => 'acara',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::acara,
                ],
                'value' => 'refAcara.desc'
            ],
            // 'session_id',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
