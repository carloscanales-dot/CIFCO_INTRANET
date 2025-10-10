<x-mail::message>
<div style="text-align: center;">
    <!-- Logo centrado -->
    <img src="{{ asset('img/LOGO CIFCO 1 TINTA-01.png') }}" alt="CIFCO" width="150" style="margin-bottom: 20px; display: block; margin-left: auto; margin-right: auto;">

    <!-- Título y contenido centrado -->
    <h1 style="text-align: center;">Notificación de Reseteo de Contraseña</h1>

    <p style="text-align: center;">
        Hola <strong>{{ $user->name }}</strong>,<br><br>

        Tu contraseña ha sido reseteada por un administrador.<br><br>

        Tu nueva contraseña es: <strong>{{ $newPassword }}</strong><br><br>

        Te recomendamos encarecidamente que inicies sesión y cambies esta contraseña por una de tu elección lo antes posible desde tu perfil.<br><br>

        Gracias,<br>
        Unidad de Informática
    </p>
</div>
</x-mail::message>
