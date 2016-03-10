<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisElaunJurulatih */

$this->title = 'Create Ref Jenis Elaun Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Elaun Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-elaun-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
