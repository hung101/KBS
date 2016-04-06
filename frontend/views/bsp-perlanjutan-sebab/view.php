<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

// contant values
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanSebab */

//$this->title = $model->bsp_perlanjutan_sebab_id;
$this->title = GeneralLabel::viewTitle . ' Sebab Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sebab_pelanjutan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-sebab-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(GeneralLabel::update, ['update', 'id' => $model->bsp_perlanjutan_sebab_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(GeneralLabel::delete, ['delete', 'id' => $model->bsp_perlanjutan_sebab_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => GeneralMessage::confirmDelete,
                'method' => 'post',
            ],
        ]) ?>
    </p>-->
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

    <?php /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bsp_perlanjutan_sebab_id',
            'bsp_perlanjutan_id',
            'sebab',
        ],
    ]);*/ ?>

</div>
