<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TempahanKursusPersatuan */

$this->title = GeneralLabel::tambah_tempahan_kursus_persatuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempahan_kursus_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempahan-kursus-persatuan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
