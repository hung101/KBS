<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTindakanSelanjutnyaRehabilitasi */

$this->title = 'Create Ref Tindakan Selanjutnya Rehabilitasi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tindakan Selanjutnya Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tindakan-selanjutnya-rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
