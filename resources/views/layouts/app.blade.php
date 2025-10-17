<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Autumn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary: #E67E22; /* Pumpkin Orange */
      --bg: #FFF9F3; /* Cream White */
      --nav: #3B2F2F; /* Dark Roast */
    }
    body { background: var(--bg); color: #3B2F2F; }
    .navbar { background: var(--nav); }
    .btn-primary { background: var(--primary); border: none; }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('dashboard') }}">Autumn Café</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('menu.index') }}">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('orders.create') }}">New Order</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('transactions.index') }}">Transactions</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container py-4">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
