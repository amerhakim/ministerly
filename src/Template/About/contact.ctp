<?php
$this->extend('OpenEmis./Layout/Panel');
$this->start('panelBody');
?>
<div class="wrapper panel panel-body">
	<!-- Contact Info -->
	<div class="about-wrapper">
		<div class="about-container">
			<div class="img-logo">
				<?= $this->Html->image('classera_logo.png');?>
			</div>	

			<div class="about-content">
				<p><a href="https://classera.com" target="blank">Classera EMS</a> is a comprehensive Education Management Information System (EMIS) designed to collect and report data on schools, students, teachers and staff. Built on proven open source technology, Classera EMS can be easily customized to meet the specific needs of educational institutions worldwide.</p>

				<div class="about-info">
					<i class="fa fa-phone fa-lg"></i>
					<span>+1 (555) 123-4567</span>
				</div>

				<div class="about-info">
					<i class="fa fa-envelope"></i>
					<span>
						<a href="mailto:support@classera.com">support@classera.com</a>
					</span>	
				</div>

				<div class="about-info">
					<i class="fa fa-map-marker fa-lg"></i>
					<span>Classera Headquarters, Education Technology Center</span>
				</div>
			</div>
		</div>	
	</div>
</div>
<?php $this->end() ?>