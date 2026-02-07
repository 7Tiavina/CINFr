<!doctype html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <style>
    #contact { padding: 40px 0; background: #f8f9fa; }
    .contact-container { max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    #contact h2 { text-align: center; margin-bottom: 30px; }
    .form-group { margin-bottom: 20px; }
    .form-group input,
    .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
    .form-submit { text-align: center; margin-top: 20px; }
    .form-submit button { padding: 12px 25px; background-color: #0444ec; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
  </style>

  <link rel="icon" href="images/favicon.webp" type="image/webp">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css" type="text/css" />
  <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
  <title>Nous Contacter - CINFr</title>
</head>
<body>

  @include('layouts.navbar')

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


  <section id="banner">
    <div class="container text-center">
      <div>:</div>
      <h1 class="mt-3"></h1>
    </div>
  </section>

  @if($errors->has('captcha'))
    <div class="alert alert-danger">
      {{ $errors->first('captcha') }}
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success text-center" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; border: 1px solid #c3e6cb; margin-bottom: 20px;">
      {{ session('success') }}
    </div>
  @endif

  <section id="contact">
    <div class="contact-container">
      <h2>Contactez-nous</h2>
      <form action="{{ route('contact.store') }}" method="POST">
        @csrf
        <div style="display:none;">
          <input type="text" name="honeypot" value="">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required value="{{ old('email') }}">
        </div>
        <div class="form-group">
          <label for="sujet">Sujet</label>
          <input type="text" id="sujet" name="sujet" required value="{{ old('sujet') }}">
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
        </div>

        {{-- reCAPTCHA :  --}}
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <div class="g-recaptcha mb-3" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>

        <div class="form-submit">
          <button type="submit">Envoyer</button>
        </div>
      </form>
    </div>
  </section>

  @include('layouts.footer')

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>
