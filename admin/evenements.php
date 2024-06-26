<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container mt-5">
    <center><h2>Liste des evenements </h2></center>
    <a href="createEvent.php" class="btn btn-primary my-3">Ajouter evenement</a>
    <table class="table table-hover border">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Date_evenement</th>
                <th>lieu </th>
                <th>Heure Début</th>
                <th>Heure Fin</th>
                <th style="text-align:center">Actions</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            require_once 'config.php';

            // Sélection des membres
            $sql = "SELECT * FROM evenements";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                   
                    echo "<td>".$row['evenement_id']."</td>";
                    echo "<td>".$row['nom']."</td>";
                    echo "<td>".$row['date_evenement']."</td>";
                    echo "<td>".$row['lieu']."</td>";
                    echo "<td>".$row['heure_debut']."</td>";
                    echo "<td>".$row['heure_fin']."</td>";
                    echo "<td>
                           
                            <a href='updateEvent.php?id=".$row['evenement_id']."' class='btn btn-warning'>Modifier</a>
                            <a href='deleteEvent.php?id=".$row['evenement_id']."' class='btn btn-danger'>Supprimer</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun membre trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
    </div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>