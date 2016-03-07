<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsNotisAgm */

//$this->title = $model->tbl_ltbs_id;
$this->title = 'Notis Mesyuarat Agong';
$this->params['breadcrumbs'][] = ['label' => 'Notis Mesyuarat Agong', 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::viewTitle;
?>
<div class="ltbs-notis-agm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-notis-agm']['update'])): ?>
            <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->tbl_ltbs_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(isset(Yii::$app->user->identity->peranan_akses['PJS']['ltbs-notis-agm']['delete'])): ?>
            <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->tbl_ltbs_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => GeneralMessage::confirmDelete,
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tbl_ltbs_id',
            'notis_agm',
        ],
    ])*/ ?>

</div>
