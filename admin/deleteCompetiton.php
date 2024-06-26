<?php
include 'config.php';

// Vérifier si l'ID du competition est passé en paramètre
if(isset($_GET['id'])) {
    $competition_id = $_GET['id'];

    // Requête pour récupérer les détails du competition
    $query = "SELECT * FROM competitions WHERE competition_id = $competition_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer le competition
            $delete_query = "DELETE FROM competitions WHERE competition_id='$competition_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression d'\competition: " . mysqli_error($conn));
            }
            header("Location: competitions.php");
        }
?>
<?php include('includes/header.php'); 
include('includes/navbar.php');  ?>
    <div class="container mt-5">
        <h2 class="mb-4">Supprimer l'competition</h2>
        <div class="card">
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer cet competition?</p>
                <h5 class="card-title">Nom Complet: <?php echo  $row['nom']; ?></h5>
                <p class="card-text">Date: <?php echo $row['date_debut']; ?></p>
                <p class="card-text">Lieu: <?php echo $row['lieu']; ?></p>
                
                <form method="POST">
                    <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                    <a href="competitions.php" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>

<?php
    } else {
        echo "Aucun competition trouvé avec cet ID.";
    }
} else {
    echo "ID du competition non spécifié.";
}
include('includes/scripts.php'); 
include('includes/footer.php'); 

?>
