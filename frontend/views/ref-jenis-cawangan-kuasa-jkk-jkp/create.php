<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisCawanganKuasaJkkJkp */

$this->title = 'Create Ref Jenis Cawangan Kuasa Jkk Jkp';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Cawangan Kuasa Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-cawangan-kuasa-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
