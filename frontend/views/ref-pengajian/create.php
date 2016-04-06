<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPengajian */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pengajian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
