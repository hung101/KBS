<?php
use app\models\LawatanRasmiLuarNegara;
use app\models\LawatanRasmiLuarNegaraDelegasi;
use app\models\LawatanRasmiLuarNegaraPegawai;

// table reference
use app\models\RefNegara;
use app\models\RefLawatan;

$mulaDisplay = null;
$hinggaDisplay = null;
$negaraDisplay = null;

if($model->tarikh_dari != ''){
	$mulaDisplay = date('d/m/Y', strtotime($model->tarikh_dari));
}

if($model->tarikh_hingga != ''){
	$hinggaDisplay = date('d/m/Y', strtotime($model->tarikh_hingga));
}

if($model->negara != ''){
	$ref = RefNegara::findOne(['id' => $model->negara]);
	$negaraDisplay = $ref['desc'];
}

$dataSource = LawatanRasmiLuarNegara::find()
                ->joinWith(['refNegara'])
                ->joinWith(['refLawatan']);
				//->where(['LIKE', 'tbl_ref_lawatan.desc', 'lawatan dari negara luar']);
				
if($mulaDisplay != null)
{
	$dataSource = $dataSource->andFilterWhere(['>=', 'tarikh', $model->tarikh_dari]);
}

if($hinggaDisplay != null)
{
	$dataSource = $dataSource->andFilterWhere(['<=', 'tarikh', $model->tarikh_hingga]);
}

if($negaraDisplay != null){
	$dataSource = $dataSource->andFilterWhere(['negara' => $model->negara]);
}

if($model->jenis_lawatan != ''){
	$dataSource = $dataSource->andFilterWhere(['tbl_ref_lawatan.id' => $model->jenis_lawatan]);
	
	$ref = RefLawatan::findOne($model->jenis_lawatan);
	$lawatan = $ref['desc'];
	if($lawatan === 'Lawatan Ke Negara Luar'){
		$title = 'Laporan Lawatan Ke Negara Luar';
	}
} else {
	$title = 'Laporan Lawatan Ke Negara Luar / Lawatan Negara-Negara Luar Ke Malaysia';
}
            
$dataSource = $dataSource->all();

?>

<div class="form-title" align="center" style="margin-bottom:10px"><?= strtoupper($title) ?></div>

<table border="0">
	<?php
	if($mulaDisplay != null){
		echo '<tr><td class="text-bold">Dari</td><td>:</td><td>'.$mulaDisplay.'</td></tr>';
	}
	if($hinggaDisplay != null){
		echo '<tr><td class="text-bold">Hingga</td><td>:</td><td>'.$hinggaDisplay.'</td></tr>';
	}
	if($negaraDisplay != null){
		echo '<tr><td class="text-bold">Negara</td><td>:</td><td>'.$negaraDisplay.'</td></tr>';
	}
	?>
</table>

<?php
if(count($dataSource) > 0){
?>
<table border="1" cellspacing="0" cellpadding="5" style="margin-top:10px" width="100%">
    <tr>
        <th>BIL</th>
		<?php
		if($negaraDisplay === null){
		?>
			<th>NEGARA / COUNTRY</th>
		<?php
		}
		if($model->jenis_lawatan === ''){
			echo '<th>LAWATAN</th>';
		}
		?>
        <th>TARIKH LAWATAN / DATE OF VISIT</th>
        <th>SENARAI DELEGASI / LIST OF DELEGATION</th>
        <th>PEGAWAI / OFFICER</th>
        <th>STATUS</th>
    </tr>
    <?php
    $bil = 1;
    foreach($dataSource as $item)
    {
		$delegasi = LawatanRasmiLuarNegaraDelegasi::find()->where(['lawatan_rasmi_luar_negara_id' => $item->lawatan_rasmi_luar_negara_id])->all();
		$pegawai = LawatanRasmiLuarNegaraPegawai::find()->where(['lawatan_rasmi_luar_negara_id' => $item->lawatan_rasmi_luar_negara_id])->all();
    ?>
    <tr>
        <td valign="top" align="center"><?= $bil ?></td>
		<?php
		if($negaraDisplay === null){
			?>
			<td valign="top">
				<?= $item->refNegara->desc ?>
			</td>
			<?php
		}
		if($model->jenis_lawatan === ''){
			$ref = RefLawatan::findOne($item->lawatan);
			$lawatan = $ref['desc'];
			echo '<td>'.$lawatan.'</td>';
		}
		?>
        <td valign="top" align="center"><?= date('d.m.Y', strtotime($item->tarikh)) ?></td>
        <td valign="top">
			<ol style="list-style-type: decimal">
			<?php
			foreach($delegasi as $d){
				echo '<li>'.$d->delegasi.'</li>';
			}
			?>
			</ol>
		</td>
        <td valign="top">
			<ol style="list-style-type: decimal">
			<?php
			foreach($pegawai as $p){
				echo '<li>'.$p->nama_pegawai_terlibat.'</li>';
			}
			?>
			</ol>
        </td>
        <td valign="top"><?= $item->catatan ?></td>
    </tr>
    <?php
    $bil++;
    }
    ?>
</table>
<?php
}
else {
?>
	<div class="title-header-wrap" style="height:36px; line-height:36px; margin:20px 0px">
		TIADA REKOD
	</div>
<?php
}
?>