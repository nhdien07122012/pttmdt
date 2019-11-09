<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<table>
    <thead>
		<tr>
			<th><u>Order</u></th>
			<th><u>Name</u></th> 
			<th><u>Shortcode</u></th>
			<th><u>ID</u></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
    <tbody>
		<?php
			if ($resultat) {
				$i = 0;
				foreach ($resultat as $key => $value) {
					$i++;			   
					$id = $value->id;
					$title = $value->title;    
					if($i>1) break;
				?>
				<tr>
					<td><?php echo "$i"; ?></td>
					<td><?php echo $title; ?></td>
					<td><?php echo "[Float-Menu id=$id]"; ?></td>
					<td><?php echo "$id"; ?></td>         
					<td><u><a href="admin.php?page=<?php echo $this->pluginname;?>&tool=add&act=update&id=<?php echo $id; ?>">Edit</a></u></td>
					<td><u><a href="admin.php?page=<?php echo $this->pluginname;?>&info=del&did=<?php echo $id; ?>">Delete</a></u></td>
					<td><u></u></td>        
				</tr>
				<?php
				}
			}
		?>
	</tbody>
</table>