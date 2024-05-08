<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Think of DG Think of DG- Login</title>
    <link rel="stylesheet" href="/login/style.css">
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    --}}


</head>


<body>
    @if (session('danger'))
    <div style="display: flex; justify-content: center; padding:5px 10px">
        <p style="color: red">{{ session('danger') }}</p>
    </div>
    @endif
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="/login/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">Forget password</h1>
                <form action="{{ route('fogotpassword') }} " method="POST">
                    @csrf
                    <input name="email" type="email" placeholder="ENTER YOUR EMAIL" />
                    @if ($errors->has('email'))
                    <span style="color: red">{{ $errors->first('email') }} </span>
                    @endif
                    <button type="submit" class="opacity">SUBMIT</button>
                </form>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>

<script src="/login/script.js"></script>



</html>