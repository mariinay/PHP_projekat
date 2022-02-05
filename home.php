<?php

require "dbBroker.php";
require "model/prijava.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$rezultat = Prijava::getAll($conn);

if (!$rezultat) {
    echo ("Neuspesna konekcija");
    die();
} else {



?>




    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <link rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <title>NON STOP Fitness: Zakazivanje treninga</title>

    </head>

    <body>

        <div class="div1">
            <h1>Zakazivanje treninga</h1>
        </div> <br><br><br>

        <div class="row1">
            <div class="div3">
                <button id="vidi" class="btn_vidi"> Zakazani treninzi</button>
            </div><br>

            <div class="div4">
                <button id="prijavise" type="button" class="btn_prijavise" data-toggle="modal" data-target="#prikaziModal">Zakaži</button>

            </div>

            <div class="div5">

                <input type="text" id="ulaz" onkeyup="nadji()" placeholder="Pretraži treninge po teretani">

            </div><br>

            <br>

        </div>



        <div id="pregled" class="divp">



            <div class="div6">


                <table id="tabela" class="tabela" border="3">
                    <thead class="zaglavlje">
                        <tr>
                            <th scope="kolona">Teretana</th>
                            <th scope="kolona">Lokacija</th>
                            <th scope="kolona">Datum</th>
                            <th scope="kolona">Vreme</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($red = $rezultat->fetch_array()) :
                        ?>
                            <tr>
                                <td><?php echo $red["teretana"] ?></td>
                                <td><?php echo $red["lokacija"] ?></td>
                                <td><?php echo $red["datum"] ?></td>
                                <td><?php echo $red["vreme"] ?></td>
                                <td>
                                    <label class="oznaci">
                                        <input type="radio" name="cekiranje" value=<?php echo $red["id"] ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>

                            </tr>
                    <?php
                        endwhile;
                    }
                    ?>
                    </tbody>
                </table>
                <div class="row">

                    <div class="div10">
                        <button id="uredi" class="btn_uredi" onclick="sortirajTabelu()">Sortiraj</button>
                    </div>
                    <div class="div10">
                        <button id="btn-obrisi" type="button" formmethod="post" class="btn btn-danger">Otkaži</button>
                    </div>

                </div>
            </div>
        </div>









        <div class="modal" id="prikaziModal" role="dialog">
            <div class="div12">


                <div class="modal-content" id="zakazi">
                    <div class="div14">
                        <button type="button" class="zatvori" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="div15">
                        <div class="fprijava">
                            <form action="#" method="post" id="dodajForm">
                                <h3>Zakaži</h3>
                                <div class="row">
                                    <div class="div16 ">

                                        <div class="form-group">
                                            <label for="">Teretana: </label>
                                            <input type="text" name="naziv" class="form-control" />
                                        </div><br>

                                        <div class="form-group">
                                            <label for="mesto">Lokacija: </label>
                                            <input type="text" name="lokacija" class="form-control" />
                                        </div><br>

                                        <div class="div18">
                                            <div class="form-group">
                                                <label for="">Datum: </label>
                                                <input type="date" name="datum" class="form-control" />
                                            </div>
                                        </div><br>


                                        <div class="form-group">
                                            <label for="">Vreme: </label>
                                            <input type="time" name="vreme" class="form-control" />
                                        </div><br>

                                        <div class="form-group">
                                            <button id="btnDodaj" type="submit" class="btn btn-success btn-block">Zakaži</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>




        <script>
            function sortirajTabelu() {
                console.log("Pozvana");
                var table, rows, s, i, a, b, shouldS;
                table = document.getElementById("tabela");
                s = true;

                while (s) {
                    s = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldS = false;
                        a = rows[i].getElementsByTagName("td")[1];
                        b = rows[i + 1].getElementsByTagName("td")[1];
                        if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
                            shouldS = true;
                            break;
                        }
                    }
                    if (shouldS) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        s = true;
                    }
                }
            }




            function nadji() {
                var unos, filter, table, tr, td, i, txtValue;
                unos = document.getElementById("ulaz");
                filter = unos.value.toUpperCase();
                table = document.getElementById("tabela");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>

    </body>

    </html>