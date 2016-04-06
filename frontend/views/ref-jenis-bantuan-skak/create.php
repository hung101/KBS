<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBantuanSkak */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_bantuan_skak;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_bantuan_skaks, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bantuan-skak-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
