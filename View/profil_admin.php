<?php
require '../includs/autoload.inc.php';

use admin\admin;
use bien\bien;
use personne\personne;

session_start();

if (!empty($_SESSION["ID_PAdmin"])) {

    $personne = new personne;
    $admin = new admin;
    $bien = new bien;
    $row1 = $personne->getInfoPersonnel($_SESSION["ID_PAdmin"]);
    $rows = $bien->getInfoReservation();
    $nb_client = $admin->getNbClient();
    $nb_reservation = $admin->getNB_reservation();
    $total_dh = $admin->getTotalDH();
    $info_client = $admin->get_client();
    $nb_trach = $admin->get_Nb_Trach();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <title>Document</title>
</head>

<body>
    <?php include '../includs/headre.php'; ?>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12  mt-5 ">
                <div class="row">
                    <hr>
                    <div class="col-lg-3 col-md-4 col-sm-12 ">
                        <img src="../img/user.jpg" width="220px" height="250px" alt="">
                    </div>
                    <div class="col-lg-9 col-md-4 col-sm-12 ">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="text-muted border-1 border-bottom border-secondary ">Admin </h2>
                                <?php echo $row1; ?>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="card border-info col-lg-4 ms-3 mb-3" style="max-width: 8rem;">
                                        <div class="card-header bg-transparent border-success"><a data-bs-toggle="collapse" href="#collapseTB" role="button" aria-expanded="false" aria-controls="collapseTB">N°_Client</a> </div>
                                        <div class="card-body">
                                            <h2 class="card-title text-center"><?php echo $nb_client["NB"]; ?></h2>
                                        </div>
                                    </div>
                                    <div class="card border-info col-lg-4 ms-3 mb-3" style="max-width: 15rem;">
                                        <div class="card-header bg-transparent border-success">N°_Reservation</div>
                                        <div class="card-body">
                                            <h2 class="card-title text-center"><?php echo $nb_reservation["NB"]; ?></h2>
                                        </div>
                                    </div>
                                    <div class="card border-info col-lg-4 ms-3 mb-3" style="max-width: 15rem;">
                                        <div class="card-header bg-transparent border-success">Total achievement </div>
                                        <div class="card-body">
                                            <h2 class="card-title text-center"><?php echo $total_dh["DH"]; ?> DH</h2>
                                        </div>
                                    </div>
                                    <div class="card border-info col-lg-4 ms-3 mb-3" style="max-width: 8rem;">
                                        <div class="card-header bg-transparent border-success"><a data-bs-toggle="collapse" href="#collapseTR" role="button" aria-expanded="false" aria-controls="collapseTB">Trach</a> </div>
                                        <div class="card-body">
                                            <h2 class="card-title text-center"> <?php echo $nb_trach["trach"]; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <hr>
        </div>
    </div>

    <div class="container mt-4 ">
        <div class="row row-cols-md-2 g-5 mt-4 ">
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="collapse" id="collapseTB">
                    <h3 class="mb-3">Table Client Information </h3>
                    <table class="table table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>Date Inscription</th>
                        </tr>
                        <?php
                        foreach ($info_client as $row) {
                        ?>
                            <tr>
                                <td><?php echo $row["id_client"]; ?></td>
                                <td><?php echo $row["Nom"]; ?></td>
                                <td><?php echo $row["Prenom"]; ?></td>
                                <td><?php echo $row["Email"]; ?></td>
                                <td><?php echo $row["Date_inscr"]; ?></td>
                            </tr>
                        <?php

                        } ?>
                    </table>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 collapse " id="collapseTR">
                <h3>Trach </h3>
                <div class="row">

                    <?php
                    foreach ($rows as $row) {
                        if ($row["archive"] == 1) { ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                                <div class="card w-75">
                                    <img src="<?php echo $row["img"]; ?>" width="250px" height="250px" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">Bien Info</h5>
                                        <hr>
                                        <p class="card-text"><b>Client :</b> <?php echo $row["Nom"] . " " .  $row["Prenom"]; ?> </p>
                                        <p class="card-text"><b>Email :</b> <?php echo $row["Email"]; ?> </p>
                                        <div class="collapse" id="collapseExample<?php echo $row["id_bien"]; ?>">
                                            <p class="card-text"><b>Bien :</b> <?php echo $row["Nom_Type"]; ?></p>
                                            <p class="card-text"><b>Type de lit :</b> <?php echo $row["Type_Lit"]; ?></p>
                                            <p class="card-text"><b>Type vue :</b> <?php echo $row["Type_Vue"]; ?></p>
                                            <p class="card-text"><b>Type pension :</b> <?php echo $row["Type_Pension"]; ?></p>
                                            <p class="card-text"><b>Prix :</b> <?php echo $row["PRIX"]; ?> </p>
                                            <p class="card-text"><b>Nombre des Jours :</b> <?php echo $row["NB_Jour"]; ?></p>
                                        </div>
                                        <hr>

                                        <a href="../controller/controller.php?update= <?php echo $row["id_bien"]; ?>" class="btn rounded-pill btn-danger float-end ms-2"><i class="fas fa-trash"></i></a>
                                        <a class="btn btn-primary rounded-pill" data-bs-toggle="collapse" href="#collapseExample<?php echo $row["id_bien"]; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="far fa-caret-square-down"></i></a>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Date reservation <?php echo $row["date_reserver"]; ?> </small>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } ?>
                </div>
                <hr>
            </div>
            <h3 class="col-lg-12">Reservation No Valider</h3>
            <hr class="col-lg-12">
            <?php
            foreach ($rows as $row) {
                if ($row["archive"] == 0 && $row["valide"] == 0) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                        <div class="card w-75">
                            <img src="<?php echo $row["img"]; ?>" width="250px" height="250px" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Bien Info</h5>
                                <hr>
                                <p class="card-text"><b>Client :</b> <?php echo $row["Nom"] . " " .  $row["Prenom"]; ?> </p>
                                <p class="card-text"><b>Email :</b> <?php echo $row["Email"]; ?> </p>
                                <div class="collapse" id="collapseExample<?php echo $row["id_bien"]; ?>">
                                    <p class="card-text"><b>Bien :</b> <?php echo $row["Nom_Type"]; ?></p>
                                    <p class="card-text"><b>Type de lit :</b> <?php echo $row["Type_Lit"]; ?></p>
                                    <p class="card-text"><b>Type vue :</b> <?php echo $row["Type_Vue"]; ?></p>
                                    <p class="card-text"><b>Type pension :</b> <?php echo $row["Type_Pension"]; ?></p>
                                    <p class="card-text"><b>Prix :</b> <?php echo $row["PRIX"]; ?> </p>
                                    <p class="card-text"><b>Nombre des Jours :</b> <?php echo $row["NB_Jour"]; ?></p>
                                </div>
                                <hr>
                                <a href="../controller/controller.php?deladm= <?php echo $row["id_bien"]; ?>" class="btn rounded-pill btn-danger float-end ms-2"><i class="fas fa-trash"></i></a>
                                <a href="../controller/controller.php?valide= <?php echo $row["id_bien"]; ?>" class="btn rounded-pill btn-success float-end ms-2"><i class="far fa-check-circle"></i></a>
                                <a class="btn btn-primary rounded-pill" data-bs-toggle="collapse" href="#collapseExample<?php echo $row["id_bien"]; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="far fa-caret-square-down"></i></a>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Date reservation <?php echo $row["date_reserver"]; ?> </small>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } ?>
            <h3 class="col-lg-12">Reservation Valider</h3>
            <hr class="col-lg-12">
            <?php
            foreach ($rows as $row) {
                if ($row["archive"] == 0 && $row["valide"] == 1) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-5">
                        <div class="card w-75">
                            <img src="<?php echo $row["img"]; ?>" width="250px" height="250px" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Bien Info</h5>
                                <span class="badge rounded-pill bg-secondary float-end">VALIDER</span>
                                <hr>
                                <p class="card-text"><b>Client :</b> <?php echo $row["Nom"] . " " .  $row["Prenom"]; ?> </p>
                                <p class="card-text"><b>Email :</b> <?php echo $row["Email"]; ?> </p>
                                <div class="collapse" id="collapseExample<?php echo $row["id_bien"]; ?>">
                                    <p class="card-text"><b>Bien :</b> <?php echo $row["Nom_Type"]; ?></p>
                                    <p class="card-text"><b>Type de lit :</b> <?php echo $row["Type_Lit"]; ?></p>
                                    <p class="card-text"><b>Type vue :</b> <?php echo $row["Type_Vue"]; ?></p>
                                    <p class="card-text"><b>Type pension :</b> <?php echo $row["Type_Pension"]; ?></p>
                                    <p class="card-text"><b>Prix :</b> <?php echo $row["PRIX"]; ?> </p>
                                    <p class="card-text"><b>Nombre des Jours :</b> <?php echo $row["NB_Jour"]; ?></p>
                                </div>
                                <hr>
                                <a href="../controller/controller.php?deladm= <?php echo $row["id_bien"]; ?>" class="btn rounded-pill btn-danger float-end ms-2"><i class="fas fa-trash"></i></a>


                                <a class="btn btn-primary rounded-pill" data-bs-toggle="collapse" href="#collapseExample<?php echo $row["id_bien"]; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="far fa-caret-square-down"></i></a>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Date reservation <?php echo $row["date_reserver"]; ?> </small>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } ?>
        </div>

    </div>
    <?php include '../includs/footer.php'; ?>
    <script src="../js/bootstrap.js"></script>
</body>

</html>