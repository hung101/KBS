<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatPengalamanJurulatih */

$this->title = GeneralLabel::createTitle.' '.'Ref Peringkat Pengalaman Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Pengalaman Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-pengalaman-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
