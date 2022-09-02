@component('mail::message')
# Bienvenid@

## Dirigido a: {{$name}}
{{$mensajeCorreo}}
### Correo: {{$email}}
### Contraseña: {{$password}}

Es importante que inicie sesión y confirme su correo electrónico, una vez confirmado se recomienda ir al perfil y cambiar la contraseña.

@component('mail::button', ['url' => 'http://ditecp.xyz/login'])
Ingresar.
@endcomponent

Gracias,<br>
© {{ date('Y') }} {{ config('app.name') }}
@endcomponent