<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisDietDataKlinikal */

$this->title = 'Create Ref Jenis Diet Data Klinikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Diet Data Klinikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-diet-data-klinikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
