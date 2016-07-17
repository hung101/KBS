<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JurulatihSukanAcara */

$this->title = 'Create Jurulatih Sukan Acara';
$this->params['breadcrumbs'][] = ['label' => 'Jurulatih Sukan Acaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-sukan-acara-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
