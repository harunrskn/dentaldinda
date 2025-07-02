<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dental - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body {
        min-height: 100vh;
        display: flex;
        flex-direction: row;
      }
      nav.sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        background-color: #003366;
        color: white;
      }
      nav.sidebar a {
        color: white;
        display: block;
        padding: 1rem 1.5rem;
        text-decoration: none;
        font-weight: 600;
      }
      nav.sidebar a:hover {
        background-color: #00509e;
      }
      main.content {
        margin-left: 250px;
        padding: 2rem;
        flex-grow: 1;
        background-color: #f8f9fa;
      }
      .card-header {
        background-color: #00509e;
        color: white;
      }
    </style>
</head>
<body>
  <nav class="sidebar d-flex flex-column">
    <h3 class="text-center mt-3 mb-4">Dental Admin</h3>
    <a href="{{ route('patients.index') }}">Dashboard</a>
    <a href="{{ route('patients.create') }}">Tambah Pasien</a>
    <a href="{{ route('patients.export') }}">Export Excel</a>
  </nav>

  <main class="content">
    @if(session('success'))
      <div class="alert alert-success shadow-sm rounded">{{ session('success') }}</div>
    @endif

    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
