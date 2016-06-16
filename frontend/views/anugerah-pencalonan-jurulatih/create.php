<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanJurulatih */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::anugerah_pencalonan_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pencalonan_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
