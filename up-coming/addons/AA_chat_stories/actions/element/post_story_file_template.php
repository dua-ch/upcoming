<div class="up_file">
	<div class="up_file_inside">
		<?php
		if (isset($boom['image'])) {
			echo '<img src="' . $boom['image'] . '"/>';
		} else {
			echo '<video width="320" height="240" controls><source src="' . $boom['video'] . '" type="video/' . $boom['extension'] . '"></video>';
		}
		?>

		<div class="up_file_remove olay" onclick="removeFile('<?php echo $boom['encrypt']; ?>');">
			<i class="fa fa-times"></i>
		</div>
	</div>
</div>