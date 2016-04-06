<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BiomekanikUjian */

$this->title = GeneralLabel::tambah_ujian_biomekanik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::ujian_biomekanik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomekanik-ujian-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
