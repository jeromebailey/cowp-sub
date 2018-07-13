<?
if(!empty( $this->session->userdata('status_message')) && !empty( $this->session->userdata('status_code') )){?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
			<div class="alert alert-<?=$this->session->userdata('status_code');?>"><?=$this->session->userdata('status_message');?></div>
		</div>
	</div>
<?}?>