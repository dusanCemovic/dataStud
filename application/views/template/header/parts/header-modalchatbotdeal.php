<div class="metricco-modal-for-form modal fade" id="<?php echo $modal_id; ?>" role="dialog" tabindex="-1">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close fa fa-times modal-close-button" data-dismiss="modal"></button>
				<h4 class="modal-title"><?php echo metricco_echo_string('Add new customer')?></h4>
			</div>
			<div class="modal-body urzr-modal-table-holder">

				<div class="row">

					<?php
					if ( isset( $template_modal_inputs ) ) { ?>
						<div class="col-lg-12">
							<?php load_template_view( $template_modal_inputs ); ?>
						</div>
					<?php } ?>

				</div>

			</div>
		</div>

	</div>
</div>