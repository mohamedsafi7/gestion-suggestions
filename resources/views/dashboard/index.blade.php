<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .dashboard-header {
            padding: 20px 0;
            text-align: center;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for cards */
            border: none; /* Remove border for cleaner design */
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="dashboard-header">
            <h1 class="text-primary">Dashboard           <a href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                class="btn btn-link text-decoration-none text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a> <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form></h1>             
            <p class="text-muted">Overview of Suggestions and Statistics</p>

        </div>

        <div class="row g-4">
            <!-- Time Comparison Chart -->


            <!-- Suggestions by Status Chart -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Suggestions by Status
                    </div>
                    <div class="card-body">
                        {!! $statusChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load Charts JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        {!! $timeComparisonChart->script() !!}
        {!! $statusChart->script() !!}
        
    </script>
</body>
</html>