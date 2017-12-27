<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Nuevo pedido</title>
</head>

<body>
	<p>Se ha realizado un nuevo pedido!</p>
	<p>Estos son los datos asociados al cliente</p>
	<ul>
		<li>
			<strong>Nombre: </strong>
			{{ $user->name }}
		</li>
		<li>
			<strong>Email: </strong>
			{{ $user->mail }}
		</li>
		<li>
			<strong>Fecha de pedido: </strong>
			{{ $cart->order_date }}
		</li>
	</ul>


	<p>y estos son los detalles del pedido</p>
	<ul>
		@foreach($cart->details as $detail )
		<li>
			{{$detail->product->name}} x {{$detail->quantity}} ($ {{$detail->quantity * $detail->product->price}} )
		</li>
		@endforeach
	</ul>
	<p>
		<strong>Total: </strong>
		${{ $cart->total }}
	</p>
	<hr>

	<p>
		<a href="{{ url('/admin/orders/'. $cart->id) }}">haz clic aquí</a> para obtener más información sobre el pedido
	</p>

</body>

</html>