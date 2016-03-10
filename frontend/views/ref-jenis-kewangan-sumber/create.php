<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKewanganSumber */

$this->title = 'Create Ref Jenis Kewangan Sumber';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kewangan Sumbers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kewangan-sumber-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
