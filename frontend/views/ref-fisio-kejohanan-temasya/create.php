<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefFisioKejohananTemasya */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::fisio_kejohanan_temasya;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::fisio_kejohanan_temasya, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-fisio-kejohanan-temasya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
