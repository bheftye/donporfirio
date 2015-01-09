
<!--wrapper es el que contiene a toda la pagina-->
    <div id="wrapper" class="wrapper-movil">
        <!-- Sidebar Seccion del menu -->
        <?php $page = basename($_SERVER["SCRIPT_FILENAME"]);?>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li <?php if ($page == "formvideoslide.php"){ echo "class='active'";} ?>><a href="formvideoslide.php">Reel</a>
                </li>
                <hr class="hrmenu">           
                <li <?php if ($page =="listproyecto.php"  or $page == "formproyecto.php"){ echo "class='active'";} ?>><a href="listproyecto.php">Proyectos</a>
                </li>
                <hr class="hrmenu">
                <li <?php if ($page =="listcategoria.php"  or $page == "formcategoria.php"){ echo "class='active'";} ?>><a href="listcategoria.php">Categorías</a>
                </li>
                <hr class="hrmenu">
            </ul>
        </div>
