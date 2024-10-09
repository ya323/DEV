<?php
require_once('template_header.php');
?>

    <section class="top-page">
        <header class="header"> 
            <img src="images/cv logo.jpg" alt="cv logo">
            <?php
            require_once('template_menu.php');
            renderMenuToHTML('index');
            ?>  
               
        </header>
        <div class="landing-page">
            <h1>Bienvenue à mon premier site professionel </h1>
            <h1>Yassir BENJANE</h1>
            <h2>ÉLÈVE INGÉNIEUR GÉNERALISTE | IMT NORD EUROPE</h2>
            
            <p>Etant élève ingénieur en 3éme année à L'Institut Mines Télecom Nord d'Europe
            en Industrie et service . Sérieux et ouvert d’esprit . Dynamique et motivé ,je suis à
            la recherche d’un stage PFE dans le domaine Industriel ( Supply chain /
            Production / Logistique ) pour une durée de 6 MOIS à partir de mars 2025 .</p>



            <?php
            require_once('template_footer.php');
            ?>
        </div>
    </section>
    

    
    

</body>
</html>