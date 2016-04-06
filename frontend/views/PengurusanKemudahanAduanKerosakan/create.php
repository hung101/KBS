<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanKemudahanAduanKerosakan */

$this->title = GeneralLabel::tambah_pengurusan_kemudahan_aduan_kerosakan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_kemudahan_aduan_kerosakan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-kemudahan-aduan-kerosakan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
