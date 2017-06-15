<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="hold-transition login-page">
	<div class="login-box">
	  <div class="login-logo">
		<a href="#"><b>Gestione</b>CONTI</a>
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
		<?php echo $message ?>

		<?php 
			$attr = array('id' => 'form_create');
			echo form_open(current_url(), $attr);
		?>
		  <div class="form-group has-feedback">
			  <?php
					$attr = array(
						'type'			=> 'text',
						'name'          => 'username',
						'class'			=> 'form-control',
						'placeholder'	=> 'Username',
						'value'			=> set_value('username')
					);
					echo form_input($attr);
					echo form_error('username');
				?>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			  <?php
					$attr = array(
						'type'			=> 'password',
						'name'          => 'password',
						'class'			=> 'form-control',
						'placeholder'	=> 'Password'
					);
					echo form_input($attr);
					echo form_error('password');
			  ?>
			  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		  </div>
		  <div class="row">
			<div class="col-xs-8">
			  <div class="checkbox icheck">
				<label>
				  <?php echo form_checkbox('remember', '1', TRUE); ?>
				  Ricordami
				</label>
			  </div>
			</div>
			<!-- /.col -->
			<div class="col-xs-4">
				<?php
					$attr = array(
						'class'			=> 'btn btn-primary btn-block btn-flat',
						'type'          => 'submit',
						'content'		=> 'Login'
					);
					echo form_button($attr);						
				?>
			</div>
			<!-- /.col -->
		  </div>
		<?php echo form_close() ?>
	  </div>
	  <!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->
