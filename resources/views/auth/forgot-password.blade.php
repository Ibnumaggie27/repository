<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Lupa Kata Sandi</h2>
        @if(session('status'))
            <div style="color: green;">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <label for="email">Masukan Email:</label>
            <input type="email" name="email" id="email" required>
            <br>
            <button type="submit" style="margin-top: 10px;">Kirim Link Reset</button>
        </form>
    </div>
</body>
</html>
