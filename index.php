<?php // connxion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=test", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
if (isset($_POST['btn_enregister'])) {
    $id = $_POST['student_id_popup'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $email = $_POST['email'];
    $discord = $_POST['discord'];
    $option_choisie = $_POST['option_choisie'];
    $id = $_POST['student_id_popup'];
    $sql = "UPDATE liste_sio SET Nom=:nom, Prenom=:prenom, Date_naissance=:date_naissance, adresse_mail_ecole=:email, discord=:discord, option_choisie=:option_choisie WHERE ID_ETUDIANT=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':discord', $discord);
    $stmt->bindParam(':option_choisie', $option_choisie);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="fr">


<head>
<meta charset="UTF-8">
<link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">

    <style>
        .popup {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.7);
            }

        .popup-content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            }

            /* Styles pour le bouton Modifier */
        .edit-button {
                background-color: #007bff;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                
            }
        .edit-button:hover {
                opacity: 0.5;
            }

        .save-button {
                background-color: #00c200;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

        .close-button {
                background-color: #ff0000;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

        input,
        select {
                border-radius: 20px;
            }

        table {
                border-collapse: collapse;
                width: 95%;
                margin: 0 auto;
                background-color: #fff;
                box-shadow: 25px 25px 20px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                overflow: hidden;
            }

        th,
        td {
                padding: 5px;
                text-align: center;
            }

        th {
                background-color: #2D75DC;
                font-weight: 600;
                text-transform: uppercase;
                color: white;
                font-size: 14px;
                letter-spacing: 1px;
                border-bottom: 3px solid #ddd;
            }

        td {
                border-bottom: 1px solid #ddd;
            }

        tr:last-child td {
                border-bottom: none;
            }

        tr:hover td {
                background-color: #f5f5f5;
            }

            @media screen and (max-width: 1620px) {
        .petit-ecran {
                    display: none;
                }
            }

        .banniere {
                background-color: #2D75DC;
                color: white;
                display: flex;
                white-space: nowrap;
                border-radius: 20px;
            }
        .banniere h1 {
                margin-top: 40px;
            }
        .pied_de_page {
                background-color: #2D75DC;
                color: white;
                display: flex;
                white-space: nowrap;
                border-radius: 20px;
            }
        .pied_de_page p {
                margin-top: 60px;
            }

        .lien_icone {
                padding: 10px;
                &:hover {opacity: 0.5;
            }
            }
        .isitech_logo{
                width:30%;
                margin: 30px;
                margin-right: 30%;
                margin-top: 8%;
                &:hover{
                    opacity: 0.5;
                }
                }
                
        .logos {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                transform: translateX(60%);
                top: 20px; /* Ajustez la valeur top pour définir la distance depuis le haut */
                right: 20px; /* Ajustez la valeur right pour définir la distance depuis la droite */
                flex-direction: row;
                align-items: center;
                }
        .logo_discord {
            width: 12%;
            display:flex;
            margin-bottom: 5px; 
                }

        table {
                border-collapse: collapse;
                width: 100%;
                text-align: center;
            }


        td {
            border: 1px solid #ccc;/* Ajoute une bordure fine à chaque cellule */
            border-radius: 5px; 
            padding: 8px;
            text-align: left; 
            }

        th {
            background-color: #2D75DC;
            color: #fff;
            padding: 8px;
            text-align: left; 
            border-right: 1px solid #ccc;
            }

        tr:nth-child(even) {
                background-color: #f2f2f2; /* Ajoute une couleur de fond alternative pour les lignes paires */
                }
        .modifier {
                background-color: #2D75DC;
                color: #fff;
                padding: 8px;
                text-align: left; 
                border-right: 0px solid #ccc;
                }
        

    </style>

    <header>
        <div class="banniere">
            <div>
                <a target="_blank" href="https://www.ecole-isitech.com"><img class="isitech_logo" src="\img\logo-isitech.png"></a>
            </div>
            <div>
                    <h1><b>Liste des étudiants</b></h1>
            </div>
            <div class="logos">
                
                <a target="_blank" href="https://twitter.com/ecole_isitech" class="lien_icone">
                    <img src="\img\twitter.png" alt="Logo Twitter" >
                </a>
                <a target="_blank" href="https://www.instagram.com/isitech.lyon/" class="lien_icone">
                    <img src="\img\instagram.png" alt="Logo Instagram">
                </a>
                <a target="_blank" href="https://discord.gg/M4SZtgsfs" class="lien_icone">
                    <img class="logo_discord" src="\img\discord.png" alt="Logo Discord">
                </a>
            </div>
        </div>
    </header>
</head>
    



<body>
    <div style="text-align: center;">
        <div style="margin: 5%;">
            <form action="#" method="get">
                <div style="text-align: center; display: flex;">
                    <input type="text" id="recherche" name="recherche" placeholder="Rechercher..." style="padding: 8px; border: 1px solid #ccc; border-radius: 20px; margin-right: 10px;">
                    <select id="select" name="select" style="padding: 8px; border: 1px solid #ccc; border-radius: 20px; background-color: #2D75DC; color: #fff; margin-right: 10px;" oninput="this.form()">
                        <option value="tt" selected>Tous</option>
                        <option value="SLAM">SLAM</option>
                        <option value="SISR">SISR</option>
                        <option value="Ne sait pas">Ne sait pas</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div>
        <table id="tableau">
            <thead>
                <tr>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>DATE DE NAISSANCE</th>
                    <th>ADRESSE MAIL</th>
                    <th>OPTION CHOISIE</th>
                    <th>DISCORD</th>
                    <th class="modifier">Modifier</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $slamCount = 0;
                $sisrCount = 0;
                $spCount = 0;

                $info_etudiant = $pdo->query('SELECT * FROM liste_sio');
                //boucle while pour afficher les données de la base de données
                while ($tt_info = $info_etudiant->fetch(PDO::FETCH_ASSOC)) {
                    //création de variable pour afficher les données
                    $id = $tt_info['ID_ETUDIANT'];
                    $nom = $tt_info['Nom'];
                    $prenom = $tt_info['Prenom'];
                    $date_naissance = $tt_info['Date_naissance'];
                    $option_choisie = $tt_info['option_choisie'];
                    $email = $tt_info['adresse_mail_ecole'];
                    $discord = $tt_info['discord'];

                    switch ($option_choisie) {
                        case 'SLAM':
                            $slamCount++;
                            break;
                        case 'SISR':
                            $sisrCount++;
                            break;
                        case 'Ne sait pas':
                            $spCount++;
                            break;
                        default:
                            break;
                    }
                ?>
                    <tr data-option="<?= $option_choisie ?>">
                        <td><?= $nom ?></td>
                        <td><?= $prenom ?></td>
                        <td><?= $date_naissance ?></td>
                        <td><?= $email ?></td>
                        <td><?= $option_choisie ?></td>
                        <td><?= $discord ?></td>
                        <td>
                            <input type="hidden" name="student_id" value="<?= $id ?>">
                            <button class="edit-button" onclick="showPopup(this)" data-id="<?= $id ?>" data-nom="<?= $nom ?>" data-prenom="<?= $prenom ?>" data-date="<?= $date_naissance ?>" data-email="<?= $email ?>" data-discord="<?= $discord ?>" data-option="<?= $option_choisie ?>">
                                Modifier
                            </button>
                        </td>
                    </tr>
                <?php
                //ce crochet ferme la boucle while et inclut donc le tableau dans la boucle
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
    <div style="text-align: center;">
        <h2><u>Stats des options choisies<u></h2>
        <div>SLAM: <span id="slamCount">0</span></div>
        <div>SISR: <span id="sisrCount">0</span></div>
        <div>Ne sait pas: <span id="spCount">0</span></div>
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
    </div>
    <div id="popup" class="popup">
        <div class="popup-content">
            <div style="display: flex;text-align: center;">
                <h3><b>Modifier informations élève</b></h3>
            </div>
            <div style="flex-direction: column;">
                <form action="" method="post">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?= $nom ?>"><br>
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?= $prenom ?>"><br>
                    <label for="date_naissance">Date de naissance :</label>
                    <input type="date" id="date_naissance" name="date_naissance" value="<?= $date_naissance ?>"><br>
                    <label for="email">Adresse mail :</label>
                    <input type="email" id="email" name="email" value="<?= $email ?>"><br>
                    <label for="discord">Discord :</label>
                    <input type="text" id="discord" name="discord" value="<?= $discord ?>"><br>
                    <label for="option_choisie">Option choisie :</label>
                    <select id="option_choisie" name="option_choisie">
                        <option value="SLAM">SLAM</option>
                        <option value="SISR">SISR</option>
                        <option value="Ne sait pas">Ne sait pas</option>
                    </select>

            </div>
            <br>
            <div style="display: flex; justify-content: center;">

                <input type="hidden" id="student_id_popup" name="student_id_popup">
                <div style="margin: 0 10px;">
                    <button class="save-button" name="btn_enregister" type="submit">Enregistrer</button>
                </div>
                </form>
                <button class="close-button" onclick="hidePopup()">Fermer</button>
            </div>
        </div>
    </div>
</body>
<footer>
        <div class="pied_de_page">
            <div>
                <a target="_blank" href="https://www.ecole-isitech.com"><img class="isitech_logo" src="\img\logo-isitech.png"></a>
            </div>
            <div>
                
                    <p> © Prod par Luidgi, Kemyl et Nicolas </p>
            </div>
            <div class="logos">
                
                <a target="_blank" href="https://twitter.com/ecole_isitech" class="lien_icone">
                    <img src="\img\twitter.png" alt="Logo Twitter" >
                </a>
                <a target="_blank" href="https://www.instagram.com/isitech.lyon/" class="lien_icone">
                    <img src="\img\instagram.png" alt="Logo Instagram">
                </a>
                <a target="_blank" href="https://discord.gg/M4SZtgsfs" class="lien_icone">
                    <img class="logo_discord" src="\img\discord.png" alt="Logo Discord">
                </a>
            </div>
        </div>
</footer>

<script type="text/javascript">

    document.addEventListener("DOMContentLoaded", function() {
        var searchSelect = document.getElementById("select");
        var searchInput = document.getElementById("recherche");

        searchSelect.addEventListener("change", filterTable);
        searchInput.addEventListener("input", filterTable);

        function filterTable() {
            var selectValue = searchSelect.value.toLowerCase();
            var inputValue = searchInput.value.trim().toLowerCase();

            var table = document.getElementById("tableau");
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var selectCell = row.cells[4].innerText.toLowerCase();
                var firstColCell = row.cells[0].innerText.toLowerCase();
                var secondColCell = row.cells[1].innerText.toLowerCase();

                var isSelectMatch = selectValue === "tt" || selectValue === selectCell;
                var isInputMatch = firstColCell.includes(inputValue) || secondColCell.includes(inputValue);

                if (isSelectMatch && isInputMatch) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        }

        filterTable();
    });

    function updateCounters() {
        var slamCount = <?php echo $slamCount; ?>;
        var sisrCount = <?php echo $sisrCount; ?>;
        var spCount = <?php echo $spCount; ?>;

        document.getElementById("slamCount").textContent = slamCount;
        document.getElementById("sisrCount").textContent = sisrCount;
        document.getElementById("spCount").textContent = spCount;
    }

    updateCounters();

    function showPopup(button) {
        var popup = document.getElementById("popup");
        var nomInput = document.getElementById("nom");
        var prenomInput = document.getElementById("prenom");
        var dateInput = document.getElementById("date_naissance");
        var emailInput = document.getElementById("email");
        var discordInput = document.getElementById("discord");
        var optionInput = document.getElementById("option_choisie");

        var id = button.getAttribute("data-id");
        var nom = button.getAttribute("data-nom");
        var prenom = button.getAttribute("data-prenom");
        var date = button.getAttribute("data-date");
        var email = button.getAttribute("data-email");
        var discord = button.getAttribute("data-discord");
        var option = button.getAttribute("data-option");

        nomInput.value = nom;
        prenomInput.value = prenom;
        dateInput.value = date;
        emailInput.value = email;
        discordInput.value = discord;
        optionInput.value = option;

        document.getElementById("student_id_popup").value = id;

        popup.style.display = "block";
    }

    function hidePopup() {
        var popup = document.getElementById("popup");
        popup.style.display = "none";
    }

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js">   </script>
    <script>
        // Récupérer les compteurs
        var slamCount = <?php echo $slamCount; ?>;
        var sisrCount = <?php echo $sisrCount; ?>;
        var spCount = <?php echo $spCount; ?>;

        // Afficher les compteurs dans les éléments HTML
        document.getElementById("slamCount").textContent = slamCount;
        document.getElementById("sisrCount").textContent = sisrCount;
        document.getElementById("spCount").textContent = spCount;

        // Créer un tableau avec les données du graphique
        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["SLAM", "SISR", "Ne sait pas"],
                datasets: [
                    {
                        label: "Nombre d'élèves",
                        data: [slamCount, sisrCount, spCount],
                        backgroundColor: ["#c1121f", "#6a994e", "#6c757d"],
                        borderColor: ["rgba(0, 0, 0, 1)", "rgba(0, 0, 0, 1)", "rgba(0, 0, 0, 1)"],
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                display: false,
            },
                },
        responsive: true, 
        maintainAspectRatio: false, 
        plugins: {
            legend: {
                position: 'bottom',
            },
        },
        title: {
            display: true,
            text: 'Options Choisies', 
        },
        layout: {
            padding: {
                top: 50, 
            }
        }
    },
});
    </script>
</html>