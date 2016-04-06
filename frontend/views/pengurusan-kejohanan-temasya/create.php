<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKejohananTemasya */

$this->title = GeneralLabel::createTitle . ' Pengurusan Kejohanan Temasya';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kejohanan_temasya, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kejohanan-temasya-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
