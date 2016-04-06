<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBantuanSue */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_bantuan_sue;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_bantuan_sue, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-bantuan-sue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
