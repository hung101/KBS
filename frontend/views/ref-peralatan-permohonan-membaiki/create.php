<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeralatanPermohonanMembaiki */

$this->title = 'Create Ref Peralatan Permohonan Membaiki';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peralatan Permohonan Membaikis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peralatan-permohonan-membaiki-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
