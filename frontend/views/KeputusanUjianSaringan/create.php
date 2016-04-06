<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KeputusanUjianSaringan */

$this->title = GeneralLabel::tambah_keputusan_ujian_saringan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::keputusan_ujian_saringan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keputusan-ujian-saringan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
