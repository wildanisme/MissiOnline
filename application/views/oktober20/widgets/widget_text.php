<div class="widget card mb-4 widget-text">
	<?php   
		if( isset($widget_setting['judul']) ) {
			if( !empty($widget_setting['judul'])) {
				?>					
				<h5 class="card-header">
					<?php echo trim($widget_setting['judul']);?>
				</h5>
				<?php 
			}
		}
	?>   
	<div class="content-text">
	<?php			
		if( isset($widget_setting['teks']) ) {
			if( !empty($widget_setting['teks'])) {
				echo $widget_setting['teks'];
			}
		} 
	?>  
	</div> 
</div> 