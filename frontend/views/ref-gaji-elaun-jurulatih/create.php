<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefGajiElaunJurulatih */

$this->title = 'Create Ref Gaji Elaun Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Gaji Elaun Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-gaji-elaun-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
