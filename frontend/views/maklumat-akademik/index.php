<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaklumatAkademikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::maklumat_akademik_atlet;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(GeneralLabel::tambah.' '.GeneralLabel::maklumat_akademik_small, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
                'attribute' => 'atlet',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::atlet,
                ],
				'value' => 'refAtlet.name_penuh'
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
                'attribute' => 'program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::program,
                ],
				'value' => 'refProgramSemasaSukanAtlet.desc'
            ],
			[
                'attribute' => 'no_matrik',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::no_matrix,
                ],
            ],
            //'no_matrik',
            // 'fakulti',
            // 'atlet_no_tel',
            // 'atlet_hp_no',
            // 'penasihat_akademik',
            // 'penasihat_no_tel',
            // 'penasihat_hp_no',
            // 'semester',
            // 'jumlah_semester',
            // 'jumlah_tahun',
            // 'tahun_kemasukan',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
