<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


</head>
<body>
    <div class="container mt-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Suggestions</h2>
            <a href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                class="btn btn-link text-decoration-none text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- Add Suggestion Button -->
        @if(auth()->check() && auth()->user()->role_id === 1)
            <a href="{{ route('suggestions.add') }}" class="btn btn-primary mb-4">Add Suggestion</a>
        @endif

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Suggestions Table -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Motif</th>
                    <th>Date</th>
                    <th>Perte Temps</th>
                    <th>Gain Temps</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suggestions as $suggestion)
                    <tr>
                        <td>{{ $suggestion->id }}</td>
                        <td>{{ $suggestion->titre }}</td>
                        <td>{{ $suggestion->motif }}</td>
                        <td>{{ $suggestion->date }}</td>
                        <td>{{ $suggestion->perte_temps }} hours</td>
                        <td>{{ $suggestion->gain_temps }} hours</td>
                        <td>{{ $suggestion->description }}</td>
                        <td>{{ $suggestion->statut }}</td>
                        <td>
                            @if(auth()->check() && auth()->user()->role_id === 2 && $suggestion->statut === 'en attente')
                                <form action="{{ route('suggestions.updateStatus', $suggestion->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="statut" value="approuvée" class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form action="{{ route('suggestions.updateStatus', $suggestion->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="statut" value="rejetée" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            @else
                                <span class="text-muted">No actions available</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('suggestion.delete', $suggestion->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No suggestions available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
