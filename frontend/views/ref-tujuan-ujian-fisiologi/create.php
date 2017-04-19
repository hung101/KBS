<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefTujuanUjianFisiologi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tujuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tujuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tujuan-ujian-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
