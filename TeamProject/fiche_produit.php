<?php
require_once('inc/init.inc.php');



// ---------------------------------------TRAITEMENT------------------------------------
$aside = '';

// if(isset)




// 1- Contrôler l'existence du produit demandé :
if (isset($_GET['id_produit'])) { // s'il existe l'indice id_produit dans l'URL
    // on requête en base le produit demandé pour vérifier son existence :
    $resultat = executeRequete("SELECT salle.*, produit.* FROM salle INNER JOIN produit ON salle.id_salle = produit.id_salle WHERE produit.id_produit = :id_produit", array(':id_produit'=> $_GET['id_produit']));


// p.id_produit, p.date_arrivee, p.date_depart, p.prix, s.id_salle, s.titre, s.photo, s.description, a.note FROM salle s INNER JOIN produit p ON s.id_salle = p.id_salle INNER JOIN avis a ON p.id_salle = a.id_salle WHERE p.id_produit = :id_produit

    // if ($resultat->rowCount()<=0) {
    //     header('location:page_accueil.php'); // s'il n'y a pas de résultat dans la requête, c'est que le produit n'existe pas : on oriente alors vers la boutique
    //     exit();
    // }

    // 

     print_r($resultat);
    

     // 2- Affichage du détail du produit :
    $produit = $resultat->fetch(PDO:: FETCH_ASSOC); // pas de while car qu'un seul produit
  
    $contenu .= '<article class="gauche">
                    <div>
                    <div>
                        <h3>'. $produit['titre'] .'</h3>
                    </div>
                    </div>';

    $contenu .=     '<div>
                    <span>'. $produit['note'].'</span>
                    </div>';
   
    $contenu .=     '<div>
                    <img src="'. $produit['photo'] .'" alt="">
                    </div>
                    
                </article>';
                

    $contenu .= '<article class="droite">
        
                        <h4>Description</h4>
                        <p>'. $produit['description'] .'</p>

                        <h4>Localistion</h4>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d86684.63842761688!2d-1.6307596272877707!3d47.23820066097403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4805ee81f0a8aead%3A0x40d37521e0ded30!2sNantes!5e0!3m2!1sfr!2sfr!4v1495630753263" width="600" height="450" frameborder="0" style="border:0"></iframe>
                </article>
         
                <section id="infos">
                    <h4>Informations complémentaires</h4>
                        <span>
                            <li>Départ : '. $produit['date_depart'] .'</li>
                            <li>Arrivee : '. $produit['date_arrivee'] .'</li>  
                        </span>
                            
                        <span>
                            <li>Capacité : '. $produit['pays'] .'</li>
                            <li>Catégorie : '. $produit['ville'] .'</li>         
                        </span>

                        <span>
                            <li>Adresse : '. $produit['adresse'] .'</li>
                            <li>Tarif : '. $produit['prix'] .' €</li>
                        </span>                    
               
                </section>';

    // 3- Affichage du formulaire d'ajout au panier
    $contenu .= '<div>';
        if ($produit['stock'] >0) {
            // s'il y a du stock on met le bouton d'ajout au panier
            $contenu .= '<form method="post" action="panier.php">';
                $contenu .= '<input type="hidden" name="id_produit" value="'. $produit['id_produit'] .'">';

                $contenu .= '<select name="quantite" id="quantite" class="form-group-sm form-control-static">';
                    for ($i = 1; $i <=['stock'] && $i <= 5; $i++) {
                        $contenu .= "<option>$i</option>";
                    }
                $contenu .= '</select>';

                $contenu .= '<input type="submit" name="ajout_panier" value="ajouter au panier" class="btn" style="margin:20px">';

            $contenu .= '</form>';



        }else{
            $contenu .= '<p>Indisponible</p>';
        }


}


require_once('inc/haut.inc.php');


?>

<style>

    h3{
        text-align: left;
    }

    div img{
        width: 60rem;
        height: 40rem;
    }

    img{
        width: 100%;
    }

    .gauche{

        display: inline-block;
        width: 55%;
        vertical-align: top;
    }

    
    .droite{
        display: inline-block;
        width: 35%;
        vertical-align: top;
        
        height: 40rem;
       
    }

    iframe{
        width: 40rem;
        height: 20rem;
    
    }
    
    #infos{
        display: inline-block;
    }



</style>


        <?php echo $contenu;    // affiche le détail d'un produit ?>     





<section>
    
    <article>
        
                <h3>Suggestions de produits</h3>
    </article>
            
            <!--<?php echo $aside;  // affiche les produits suggérés ?>-->
</section>



<script>
        // $(document).ready(function(){
        //     $('#myModal').modal("show");
        // });
</script>




<?php

require_once('inc/bas.inc.php');



