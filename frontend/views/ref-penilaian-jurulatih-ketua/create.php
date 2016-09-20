<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaianJurulatihKetua */

$this->title = 'Create Ref Penilaian Jurulatih Ketua';
$this->params['breadcrumbs'][] = ['label' => 'Ref Penilaian Jurulatih Ketuas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penilaian-jurulatih-ketua-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
