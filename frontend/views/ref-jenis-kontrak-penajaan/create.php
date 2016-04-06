<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKontrakPenajaan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kontrak_penajaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_kontrak_penajaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kontrak-penajaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
