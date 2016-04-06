<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapKerjayaJurulatih */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tahap_kerjaya_jurulatih;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tahap_kerjaya_jurulatih, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-kerjaya-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
