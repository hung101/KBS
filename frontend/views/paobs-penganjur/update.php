<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjur */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::paobs_penganjur.': ' . ' ' . $model->penganjur_id;
$this->title =  'Penganjuran Acara Sukan Yang Disanksi';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penganjuran_acara_sukan_yang_disanksi, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle, 'url' => ['view', 'id' => $model->penganjur_id]];
$this->params['breadcrumbs'][] = GeneralLabel::updateTitle;
?>
<div class="paobs-penganjur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
