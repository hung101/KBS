<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenilaian */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::borang_penilaian.': ' . ' ' . $model->borang_penilaian_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_penilaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->borang_penilaian_id, 'url' => ['view', 'id' => $model->borang_penilaian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borang-penilaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
