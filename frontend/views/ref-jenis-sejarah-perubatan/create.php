<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisSejarahPerubatan */

$this->title = 'Create Ref Jenis Sejarah Perubatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Sejarah Perubatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-sejarah-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
