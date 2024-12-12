<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>halaman Login</title>
        <!-- Link ke file CSS di public/css -->
        <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    </head>
    <body>
        <div class="login-container">
            <img alt="Logo 1" src="{{ asset('assets/img/tut.png') }}" />
        
            <h1>SIAK</h1>
            <h2>SISTEM INFORMASI AKADEMIK</h2>
            <h2>LOGIN</h2>
        
            {{-- Menampilkan pesan kesalahan jika ada --}}
            @if($errors->any())
                <div class="error-messages" style="color: red; margin-bottom: 10px;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="username">NIP :</label>
                <input type="text" name="username" id="username" required autofocus>
                <br>
                <label for="password">Password:</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁</span>
                </div>
                <br>
                <button type="submit">Login</button>
            </form>
            <p>
                Lupa Password? <a href="{{ route('password.request') }}">RESET</a>
            </p>
        </div>
    
        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.querySelector('.toggle-password');
                if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleIcon.classList.remove('fa-eye');
                        toggleIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        toggleIcon.classList.remove('fa-eye-slash');
                        toggleIcon.classList.add('fa-eye');
                    }
            }
        </script>
    </body>
</html>