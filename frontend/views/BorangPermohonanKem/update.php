<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPermohonanKem */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::borang_permohonan_kem.': ' . ' ' . $model->borang_permohonan_kem_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_permohonan_kem, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borang_permohonan_kem_id, 'url' => ['view', 'id' => $model->borang_permohonan_kem_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borang-permohonan-kem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
