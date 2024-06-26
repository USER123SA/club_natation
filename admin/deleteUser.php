<?php
include('includes/header.php');
include('includes/navbar.php');
include 'config.php';

// Vérifier si l'ID du utilisateur est passé en paramètre
if(isset($_GET['id'])) {
    $utilisateur_id = $_GET['id'];

    // Requête pour récupérer les détails d'utilisateur
    $query = "SELECT * FROM utilisateurs WHERE utilisateur_id = $utilisateur_id";
    $result = mysqli_query($conn, $query);

    // Vérifier si la requête a retourné des résultats
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Vérifier si le formulaire de suppression a été soumis
        if(isset($_POST['supprimer'])) {
            // Requête pour supprimer l'utilisateur
            $delete_query = "DELETE FROM utilisateurs WHERE utilisateur_id='$utilisateur_id'";
            $delete_result = mysqli_query($conn, $delete_query);
            if(!$delete_result) {
                die("Erreur de suppression d'utilisateur: " . mysqli_error($conn));
            }
            echo "<script>window.location.href='utilisateurs.php'</script>";
        }
?>

<div class="container mt-5">
    <h2 class="mb-4">Supprimer l'utilisateur</h2>
    <div class="card">
        <div class="card-body">
            <p>Êtes-vous sûr de vouloir supprimer cet utilisateur?</p>
            <p><strong>Nom:</strong> <?php echo $row['nom']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <form method="POST">
                <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                <a href="utilisateurs.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
<?php
    } else {
        echo "Aucun utilisateur trouvé avec cet ID.";
    }
} else {
    echo "ID d'utilisateur non spécifié.";
}
include('includes/scripts.php');
include('includes/footer.php');
?>
