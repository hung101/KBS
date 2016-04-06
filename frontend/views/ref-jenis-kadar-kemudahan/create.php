<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKadarKemudahan */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Kadar Kemudahan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kadar Kemudahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kadar-kemudahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
