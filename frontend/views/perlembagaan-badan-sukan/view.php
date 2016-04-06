<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PerlembagaanBadanSukan */

//$this->title = $model->perlembagaan_badan_sukan_id;
$this->title =  'Perlembagaan Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perlembagaan_badan_sukan, 'url' => Url::to(['index', 'profil_badan_sukan_id' => $profil_badan_sukan_id])];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="perlembagaan-badan-sukan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['perlembagaan-badan-sukan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->perlembagaan_badan_sukan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['perlembagaan-badan-sukan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->perlembagaan_badan_sukan_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'perlembagaan_badan_sukan_id',
            'tarikh_kelulusan_Terkini',
            'bilangan_pindaan_perlembagaan_dilakukan',
            'tarikh_pindaan',
            'tarikh_kelulusan',
            'muat_naik',
        ],
    ]);*/ ?>

</div>
