<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GajiJurulatih */

$this->title = 'Create Gaji Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Gaji Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaji-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
