<!-- Profile grid --> 
<div class="row">
	<div class="col-lg-12">
		<!-- Page tabs -->
		<div class="tabbable page-tabs">
			<div class="tab-content">				
				<!-- Fifth tab -->
				<div class="tab-pane active fade in" id="settings">
					<?php
					$row = $this->db->get('backadmin')->row_array();
					// Start Form
					echo $this->form_builder->open_form(
						array(
							'role' => 'form',
							'action' => 'backend/home/modify?panel=1&tab=1&id=1',
							'method' => 'post'
						)
					);
					// Form Input
					echo $this->form_builder->build_form_horizontal(
					    array(
						    array(
						        'id' => 'webname',
						        'label' => '網站名稱(後台名稱):',
						        'class' => 'required'
						    ),
						    array(
						        'id' => 'webtitle',
						        'label' => '網站標題(重要ＳＥＯ):',
						        'class' => 'required',
						    ),
						    array(
						        'id' => 'keyword',
						        'label' => '網站關鍵字(逗號分隔):',
						        'class' => 'required',
						    ),
						    array(
						        'id' => 'description',
						        'label' => '網站描述:',
						        'class' => 'required'
						    ),
						    array(
						        'id' => 'address',
						        'label' => '地址:',
						        'class' => 'required'
						    ),
						    array(
						        'id' => 'email',
						        'label' => 'Email:',
						        'class' => 'required'
						    ),
						    array(
						        'id' => 'tel',
						        'label' => 'Tel',
						        'class' => 'required'
						    ),
						    array(
						        'id' => 'Facebook',
						        'label' => 'Facebook連結',
						    ),
						    array(
						        'id' => 'Twitter',
						        'label' => 'Twitter連結',
						    ),
						    array(
						        'id' => 'Google',
						        'label' => 'Google連結',
						    ),
						    array(
						        'id' => 'copyright',
						        'label' => '版權宣告:',
		                        'type' => 'textarea',
		                        'class' => 'required'
						    ),
					), $row);
					?>
					<!-- End Button -->
					<div class="form-actions text-right">
						<input type="submit" value="修改內容" class="btn btn-primary">
					</div>
					<?php
					// End Form
					echo $this->form_builder->close_form();;
					?>
				</div>
				<!-- /fifth tab -->
			</div>
		</div>
		<!-- /page tabs -->
	</div>
</div>
<!-- /profile grid