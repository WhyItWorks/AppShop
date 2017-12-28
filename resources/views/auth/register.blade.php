@extends('layouts.app') @section('body-class','signup-page') @section('content')


<div class="header header-filter" style="background-image: url('{{ asset('/img/city1.jpg') }}'); background-size: cover; background-position: top center;">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="card card-signup">

					@if ( $errors -> any() )
					<div class="alert alert-danger">
						<ul>
							@foreach ( $errors -> all() as $error )
							<li>{{$error}}</li>
							@endforeach
						</ul>
					</div>
					<br> @endif

					<form class="form" method="POST" action="{{ route('register') }}">
						{{ csrf_field() }}
						<div class="header header-primary text-center">
							<h4>Registro</h4>
						</div>
						<p class="text-divider">Completa tus datos</p>
						<div class="content">

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">face</i>
								</span>
								<input id="name" type="text" class="form-control" placeholder="Nombre..." name="name" value="{{ old('name', $name) }}" required
								 autofocus>
							</div>

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">fingerprint</i>
								</span>
								<input id="username" type="text" class="form-control" placeholder="Nombre de usuario..." name="username" value="{{ old('username') }}"
								 required>
							</div>

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">email</i>
								</span>
								<input id="email" type="email" class="form-control" placeholder="Email..." name="email" value="{{ old('email', $email) }}"
								 required>
							</div>

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">phone</i>
								</span>
								<input id="phone" type="phone" class="form-control" placeholder="Teléfono..." name="phone" value="{{ old('phone') }}" required>
							</div>

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">class</i>
								</span>
								<input id="address" type="text" class="form-control" placeholder="Dirección..." name="address" value="{{ old('address') }}"
								 required>
							</div>


							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">lock_outline</i>
								</span>
								<input placeholder="Contraseña..." id="password" type="password" class="form-control" name="password" required />
								<p class="help-block">Su contraseña debe contener un mínimo de 6 carácteres</p>
							</div>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">lock_outline</i>
								</span>
								<input placeholder="Confirmar contraseña..." id="password-confirm" type="password" class="form-control" name="password_confirmation"
								 required />
							</div>


						</div>
						<div class="footer text-center">
							<button type="submit" href="#pablo" class="btn btn-simple btn-primary btn-lg">Confirmar</button>
						</div>

						<!--<a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>-->
					</form>
				</div>
			</div>
		</div>
	</div>

	@include('includes.footer')

</div>
@endsection