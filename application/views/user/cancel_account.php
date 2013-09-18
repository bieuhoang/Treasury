<div class="container mt30">
	<div class="row-fluid">
		<div class="span3">
			<?php echo $this->template->block('user_sidebar') ?>
		</div>
		<div class="span9 box">
			<div class="box-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="page-header">
							<h2>Cancel my account</h2>							
						</div>

						<form action="<?php echo site_url('user/post_cancel_account') ?>" class="form-horizontal" method="post">
							<div class="control-group">
								<label for="" class="control-label">Confirm</label>
								<div class="controls">
									<h5>Are you sure you wish to delete this account?</h5>
									<input type="text" name="confirm" value="" placeholder="Type OK to confirm.">
								</div>
							</div>
							<div class="control-group">
								<label for="" class="control-label"></label>
								<div class="controls">
									<button class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>