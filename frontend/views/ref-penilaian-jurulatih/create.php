<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaianJurulatih */

$this->title = 'Create Ref Penilaian Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Penilaian Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penilaian-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
