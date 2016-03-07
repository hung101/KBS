<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BiomekanikAnthropometrics */

$this->title = 'Tambah Biomekanik Anthropometrics';
$this->params['breadcrumbs'][] = ['label' => 'Biomekanik Anthropometrics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biomekanik-anthropometrics-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
