<?php 
include('includes/header.php'); 
include('includes/navbar.php');
include 'config.php';

// Vérifier si l'ID du heures est passé en paramètre
if(isset($_GET['id'])) {
    $heures_id = $_GET['id'];

    // Requête pour récupérer les détails du heures
    $query = "SELECT * FROM heuresentrainement WHERE heure_id = $heures_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer le heures
            $delete_query = "DELETE FROM heuresentrainement WHERE heure_id='$heures_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression du heures: " . mysqli_error($conn));
            }
           echo '<script>window.location.href="heures.php"</script>';
        }
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le heures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Supprimer le heures</h2>
        <div class="card">
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer ce heures?</p>
                <p><strong>Heures:</strong> <?php echo $row['heure'] ; ?></p>
                <p><strong>Equipe:</strong> <?php 
                // Requête pour récupérer le nom de l'équipe associée à cette heure
                $query_equipe = "SELECT nom FROM equipe WHERE id_equipe = " . $row['equipe_id'];
                $result_equipe = mysqli_query($conn, $query_equipe);
                if(mysqli_num_rows($result_equipe) > 0) {
                    $row_equipe = mysqli_fetch_assoc($result_equipe);
                    echo $row_equipe['nom'];
                } else {
                    echo "Nom d'équipe non valide";
                }?></p>
               
                <form method="POST">
                    <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                    <a href="heures.php" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        echo "Aucun heures trouvé avec cet ID.";
    }
} else {
    echo "ID du heures non spécifié.";
}


include('includes/scripts.php'); 
include('includes/footer.php'); 

?>
