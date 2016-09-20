
<table border="1">
	<thead>
		<td>Product Name</td>
		<td>price</td>	
	</thead>
	<tbody>
	<?php
		foreach ($products as $Product) {
	?>
		<tr>
		<td><?=$Product->product_name ?></td>
		<td><?=$Product->price ?></td>
		</tr>
	<?php
		}
	?>

		
	</tbody>
</table>