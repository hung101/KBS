<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsSumberKewangan */

//$this->title = $model->sumber_kewangan_id;
$this->title = GeneralLabel::viewTitle . ' Sumber Kewangan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sumber_kewangan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-sumber-kewangan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-sumber-kewangan']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->sumber_kewangan_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-sumber-kewangan']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->sumber_kewangan_id], [
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
            'sumber_kewangan_id',
            'jenis',
            'sumber',
            'jumlah',
        ],
    ])*/ ?>

</div>
