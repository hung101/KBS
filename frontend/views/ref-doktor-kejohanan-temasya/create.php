<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDoktorKejohananTemasya */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::doktor_kejohanan_temasya;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::doktor_kejohanan_temasya, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-doktor-kejohanan-temasya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
