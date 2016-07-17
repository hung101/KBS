<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKesihatanMasalah */

$this->title = 'Create Jurulatih Kesihatan Masalah';
$this->params['breadcrumbs'][] = ['label' => 'Jurulatih Kesihatan Masalahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-kesihatan-masalah-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
