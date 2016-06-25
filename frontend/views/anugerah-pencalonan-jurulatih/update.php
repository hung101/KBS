<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanJurulatih */


$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::anugerah_pencalonan_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pencalonan_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_pencalonan_jurulatih, 'url' => ['view', 'id' => $model->anugerah_pencalonan_jurulatih_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
