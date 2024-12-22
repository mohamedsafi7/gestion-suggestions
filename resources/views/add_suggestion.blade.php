<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Suggestion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .form-container {
            width: 100%;
            max-width: 500px;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="mb-4 text-center">Ajouter une suggestion</h2>

        <!-- Form to Add a Suggestion -->
        <form id="addSuggestionForm" action="/suggestions" method="POST">
           @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="mb-3">
                <label for="suggestionTitle" class="form-label">Titre</label>
                <input type="text" class="form-control" id="suggestionTitle" name="titre" placeholder="Entrer le titre" required>
            </div>
            <div class="mb-3">
                <label for="suggestionDescription" class="form-label">Description</label>
                <textarea class="form-control" id="suggestionDescription" name="description" rows="3" placeholder="Entrer Description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="suggestionDate" class="form-label">Date</label>
                <input type="date" class="form-control" id="suggestionDate" name="date" required>
            </div>


            <div class="mb-3">
                <label for="priorite" class="form-label">Priorite</label>
                <select name="priorite" id="priorite" class="form-control">
                    <option value="basse">Basse</option>
                    <option value="moyenne">Moyenne</option>
                    <option value="haute">Haute</option>
                </select>

            </div>
            <div class="mb-3">
                <label for="perteTemps" class="form-label">Perte Temps (minutes)</label>
                <input type="number" class="form-control" id="perteTemps" name="perte_temps" placeholder="Enter Perte Temps" required>
            </div>
            <div class="mb-3">
                <label for="gainTemps" class="form-label">Gain Temps (minutes)</label>
                <input type="number" class="form-control" id="gainTemps" name="gain_temps" placeholder="Enter Gain Temps" required>
            </div>

            <div class="mb-3">
                <label for="suggestionMotif" class="form-label">Motif</label>
                <input type="text" class="form-control" id="suggestionMotif" name="motif" placeholder="Enter Motif" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Suggestion</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
