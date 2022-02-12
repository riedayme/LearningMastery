<div class="row">

	<div class="col-lg-12">

		<div class="c-field u-mb-medium u-ph-medium">
			<label class="c-field__label">Currency Format</label>
			<select required="" name="currency_format" class="c-select select2">
				<option></option>
				<option value="IDR" <?php echo ($site['currency_format'] == 'IDR') ? 'selected' : ''; ?>>IDR</option>
				<option value="USD" <?php echo ($site['currency_format'] == 'USD') ? 'selected' : ''; ?>>USD</option>
			</select>
		</div>	

		<div class="c-field u-mb-medium u-ph-medium">
			<label class="c-field__label">Payment Method</label>
			<select required="" name="payment_method" class="c-select select2 select-payment">
				<option></option>
				<option value="Manual" <?php echo ($site['payment_method'] == 'Manual') ? 'selected' : ''; ?>>Manual</option>
				<option value="Midtrans" <?php echo ($site['payment_method'] == 'Midtrans') ? 'selected' : ''; ?>>Midtrans</option>
			</select>
		</div>	

	</div>	

</div>

<div class="c-stage u-m-zero u-border-bottom-zero type-midtrans" style='<?php echo ($site['payment_method'] == 'Midtrans') ? '' : 'display:none'; ?>'>
	<div class="c-stage__header o-media u-justify-start">
		<div class="c-stage__icon o-media__img">
			<i class="fa fa-info"></i>
		</div>
		<div class="c-stage__header-title o-media__body">
			<h6 class="u-mb-zero">Midtrans Key</h6>
		</div>
	</div>

	<div class="c-stage__panel u-p-medium row">

		<div class="c-field u-mb-medium col-md-12">
			<label class="c-field__label">isProduction</label>
			<select required="" name="status_production" class="c-select select2">
				<option></option>
				<option value="Yes" <?php echo ($site['payment_midtrans']['status_production'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
				<option value="No" <?php echo ($site['payment_midtrans']['status_production'] == 'No') ? 'selected' : ''; ?>>No</option>
			</select>
		</div>	

		<div class="col-lg-6">
			<div class="c-field u-mb-medium">
				<label class="c-field__label">client_key</label> 
				<input onclick='select()' class="c-input" name="client_key" type="text" placeholder="client_key" value="<?php echo (!empty($site) ? $site['payment_midtrans']['client_key'] : '') ?>"> 
			</div>
		</div>

		<div class="col-lg-6">
			<div class="c-field u-mb-medium">
				<label class="c-field__label">server_key</label> 
				<input onclick='select()' class="c-input" name="server_key" type="text" placeholder="server_key" value="<?php echo (!empty($site) ? $site['payment_midtrans']['server_key'] : '') ?>"> 
			</div>
		</div>

	</div>
</div>		