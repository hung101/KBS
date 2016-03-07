<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenyelidikanKomposisiPasukan */

$this->title = 'Tambah Penyelidikan Komposisi Pasukan';
$this->params['breadcrumbs'][] = ['label' => 'Penyelidikan Komposisi Pasukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyelidikan-komposisi-pasukan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
