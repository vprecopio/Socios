<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../assets/stylev5.css">
</head>

<body id="top">
    <?php
        include_once 'navbar.php' ?>
        <main>
            <div class="contenido-socio">
                <div class="logo">
                    <img src="../assets/logo-CADU.png" alt="Escudo CADU" class="escudo">
                </div>

                <div class="historia">
                    <p>
                        La gran historia comenzó en el año 1914. Hoy, más de 100 años después, miramos orgullosos el pasado y comenzamos esta nueva etapa con la misma pasión de siempre.
                    </p>
                    <p>
                        La institución nació el 14 de julio de 1914 después de la separación del club Defensores de Paraná, formando esta entidad y el Club Paraná. El primer presidente fue Juan Ferrari.
                    </p>
                    <p>
                        Un año después de la fundación se le agregó la designación Unidos de Zárate. Se afilió a la Federación del Norte y empezó a participar del campeonato de fútbol.
                    </p>
                    <p>
                        En 1932 obtuvo la Personería Jurídica y se afilió a la Asociación del Fútbol Argentino en 1966, comenzando a participar del torneo de Primera D. En 1969 ascendió por primera vez a Primera C, se mantuvo en ella, hasta que logró el ascenso a la Primera División “B” Metropolitana, gracias al Torneo Reducido 1987/88.
                    </p>
                    <p>
                        Permaneció una sola temporada en dicha categoría, ya que en la temporada 1988/89 bajó nuevamente a la Primera C. Dos años después, en la temporada 1990/91, descendió a la última categoría del ascenso, a la Primera D.
                    </p>
                    <p>
                        Se mantuvo únicamente un año en la “D”, porque en la 1991/92 regresó a la Primera C para ganar el Torneo Apertura de dicha categoría en la 1993/94 y así ascender nuevamente para disputar la Primera “B” Metropolitana.
                    </p>
                    <p>
                        Estuvo 4 Temporadas completas, hasta que en la 1997/98 volvió a la Primera C para estar dos temporadas y nuevamente descendió a la última categoría, a la “D” en la temporada 1999/00. En la última categoría del ascenso, permaneció durante 8 temporadas completas, hasta que pudo regresar a la Primera C, tras ganar el torneo de la temporada 2007/08.
                    </p>
                    <p>
                        En el 2018 ascendió de la Primera C a la Primera B Metropolitana y en el 2022 a la Primera Nacional.
                    </p>
                </div>

                <div class="galeria">
                    <img src="../assets/foto1.jpg" alt="Foto 1">
                    <img src="../assets/foto2.jpg" alt="Foto 2">
                    <img src="../assets/foto3.jpg" alt="Foto 3">
                </div>
            </div>        
        </main>

    <script>
        function toggleUserMenu(event) {
            event.preventDefault();
            const dropdown = document.getElementById("userDropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

        document.addEventListener("click", function(event) {
            const dropdown = document.getElementById("userDropdown");
            const userMenu = document.querySelector(".user-menu");
            if (!userMenu.contains(event.target)) {
            dropdown.style.display = "none";
            }
        });
    </script>

</body>
</html>