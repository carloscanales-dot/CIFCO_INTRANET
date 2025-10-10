<x-mail::message>
{{-- Logo --}}
<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ $message->embed(public_path('img/LOGO CIFCO 1 TINTA-01.png')) }}" alt="Logo CIFCO" width="150">
</div>

{{-- Título --}}
<h1 style="text-align: center;">Notificación de Reseteo de Contraseña</h1>

{{-- Contenido --}}
<div style="text-align: center; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">
    Hola <strong>{{ $user->name }}</strong>,<br><br>Tu contraseña ha sido reseteada por un administrador.<br><br>Tu nueva contraseña es: <strong>{{ $newPassword }}</strong><br><br>Te recomendamos encarecidamente que inicies sesión y cambies esta contraseña por una de tu elección lo antes posible desde tu perfil.<br><br>Gracias,<br>Unidad de Informática
</div>

</x-mail::message>
