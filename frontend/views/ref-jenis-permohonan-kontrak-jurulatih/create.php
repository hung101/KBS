<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPermohonanKontrakJurulatih */

$this->title = 'Create Ref Jenis Permohonan Kontrak Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Permohonan Kontrak Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-permohonan-kontrak-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
