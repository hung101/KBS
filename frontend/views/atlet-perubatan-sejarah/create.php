<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanSejarah */

$this->title = GeneralLabel::tambah_sejarah_perubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_perubatan_sejarahs, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-perubatan-sejarah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
