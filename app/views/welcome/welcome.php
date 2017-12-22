<?php
/**
 * Sample layout
 */

use Core\Language;

?>

<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>
<div class="container">
	<div class="col-sm-6">
		<form method="POST">
			<div class="row linhas">
				<div class="col-sm-3" style="padding-right: 8px;padding-left: 8px;">
					<div class="form-group">
						<input name="funcao[]" type="text" class="form-control funcao" placeholder="função" style="float: left;width:80%;" /><span style="display: inline-block;float: left;margin-top: 5px;margin-left: 18px;">:</span>
					</div>
				</div>
				<div class="col-sm-2" style="padding-right: 8px;padding-left: 8px;">
					<div class="form-group">
						<select class="form-control selectOperacao" name="operacao[]" data-select-line="1">
							<option value="1">add</option>
							<option value="2">addi</option>
							<option value="3">addu</option>
							<option value="4">sub</option>
							<option value="5">lw</option>
							<option value="6">sw</option>
							<option value="7">bne</option>
							<option value="8">beq</option>
							<option value="9">j</option>
							<option value="10">NOP</option>
						</select>
					</div>
				</div>
				<div class="col-sm-2" style="padding-right: 8px;padding-left: 8px;">
					<div class="form-group">
						<input type="text" class="form-control rd" placeholder="" name="rd[]" />
					</div>
				</div>
				<div class="col-sm-2" style="padding-right: 8px;padding-left: 8px;">
					<div class="form-group">
						<input type="text" class="form-control rs1" placeholder="" name="rs1[]"/>
					</div>
				</div>
				<div class="col-sm-3" style="padding-right: 8px;padding-left: 8px;">
					<div class="form-group">
						<input type="text" class="form-control rs2" placeholder="" name="rs2[]"/>
					</div>
				</div>
			</div>
			<div id="clones">

			</div>
			<div class="row">
				<div class="col-sm-12 text-right">
					<label><input type="checkbox" name="otimizar" checked="checked"> Reordenar</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-right">
					<button id="clonar" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
					<button id="gerar" type="button" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Gerar</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-sm-6">
		<h3 style="margin:0px;">Resultado:</h3>
		<pre id="resultado">

		</pre>
		<div><b>CPI:</b> <span id="cpi"></span></div>
	</div>
</div>