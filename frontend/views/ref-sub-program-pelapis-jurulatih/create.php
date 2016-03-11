<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSubProgramPelapisJurulatih */

$this->title = 'Create Ref Sub Program Pelapis Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sub Program Pelapis Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sub-program-pelapis-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
