<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapPenganjuran */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tahap_penganjuran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tahap_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-penganjuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
