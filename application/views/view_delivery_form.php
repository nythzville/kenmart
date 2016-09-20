<head>
	
	<style type="text/css">
	body{
		font-size: 12px;
		font-family: 'Calibri';
	}
	.wrapper{
		width: 800px;
		margin: 0 auto;
	}
	table{
		width: 100%;

	}
	table th,table td{
		padding: 10px 5px;
	}
	table tr th{
		text-align: center;
	}
	</style>
</head>
<script type="text/javascript">
	window.print();
</script>
<body>
<div class="wrapper">
	<table border="1" cellspacing="0">
		<thead>
			<tr>
				<th colspan="4">Delivery Form</th>
			</tr>
			<tr>
			<?php
			$meta = json_decode($order->meta_data);
			?>
				<td colspan="4">Customer: <?=$meta->firstname.' '.$meta->lastname ?><br/>
				Address: <?=$order->full_address ?>	
				
				</td>
			</tr>
			<tr>
				<td colspan="4">
				Supplier: Kenmart Marketing<br/>
				Address: Address: Sto. Domingo,  Arevalo, Iloilo City
				</td>

			</tr>
			<tr>
				<th>Particulars</th>
				<th>Qty.</th>
				<th>Unit Cost</th>
				<th>Amount</th>

			</tr>
		</thead>
		<tbody>
		<?php
		$total_amount = 0;
		foreach ($products as $product) {
		?>
		<tr>
			<td><?=$product->product_name; ?></td>
			<td><?=$product->ordered_quantity; ?></td>
			<td style="text-align: right;"><?=sprintf("%0.2f",$product->price); ?></td>
			<td style="text-align: right;"><?php $amount = ($product->price)*($product->ordered_quantity); echo sprintf("%0.2f",$amount); $total_amount += $amount; ?></td>
		</tr>
		<?php } ?>	
		</tbody>
		<tfoot>
			<tr>
				<th>Total Amount</th>
				<th colspan="3" style="text-align: right;"><?=sprintf("%0.2f",$total_amount); ?></th>
			</tr>
			<tr >
				<td colspan="4" style="border-bottom: none;">
				<span>Please present this form to the delivery man to authenticate the above purchase.</span>
				
				</td>
			</tr>
			<tr>
				<td colspan="4" style="border-bottom: none; border-top: none; text-align: center;">
				<span><strong><?=$order->code; ?></strong></span>
				
				</td>
			</tr>
			<tr>
				<td colspan="4" style="border-bottom: none; border-top: none; text-align: center;">
				<span>Delivery Code</span>
				
				</td>
			</tr>
		</tfoot>
	</table>
</div>
</body>