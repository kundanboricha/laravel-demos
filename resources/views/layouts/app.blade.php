<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Company App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">CompanyApp</a>
            <ul class="nav navbar-nav">
                <li><a href="{{ route('companies.index') }}">Companies</a></li>
                <li><a href="{{ route('companies.create') }}">Add Company</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="text-center mt-4">
        <p>&copy; {{ date('Y') }} CompanyApp</p>
    </footer>

</body>

</html>
