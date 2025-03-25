<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réclamations</title>
</head>
<body>
    <div class="container">
        <h4>Mes Réclamations</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Objet</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reclamations as $reclamation)
                    <tr>
                        <td>{{ $reclamation->id }}</td>
                        <td>{{ $reclamation->titre }}</td>
                        <td>{{ $reclamation->statut }}</td>
                        <td>{{ $reclamation->date_creation }}</td>
                        <td>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
