<html>
    <body>
        <form action='#' method='POST' name='nomForm'>
            Nom entité (avec Majuscule en première lettre): <input type='text' name='nomDAO'><br>
            <button type='submit'>GENERER</button>
        </form>
    </body>
</html>

<?php
    if(isset($_POST['nomDAO'])){
        $nomDAO = $_POST['nomDAO'];
        print('<h2>DAO générée : </h2>');

        // Auteur
        print('<pre>');
        print('/**<br> * @author robin.hortala<br> *<br> */<br><br>');

        // Inclusion de l'objet
        print('include "../src/'.$nomDAO.'.php";<br><br>');

        // Inclusion du gestionnaire d'entités
        print('// On récupère l\'entity manager de l\'orm doctrine<br>require_once "../bootstrap.php";<br><br>');

        // Fonction de création d'un objet
        print('/*<br> * @param param1...<br> * @return l\'id du nouveau '.strtolower($nomDAO).'<br> */<br>');
        print('function create'.$nomDAO.'(params...){<br>');
        print('    global $em;<br><br>');
        print('    $'.strtolower($nomDAO).' = new '.$nomDAO.'(params...);<br><br>');
        print('    $em->persist($'.strtolower($nomDAO).');<br>');
        print('    $em->flush();<br>');
        print('    return $'.strtolower($nomDAO).'->getId();<br>');
        print('}<br><br>');

        // Fonction de recherche d'un objet
        print('/*<br> * @param id...<br> * @return un objet '.strtolower($nomDAO).' correspondant à l\'id ou null si l\'objet avec cet id n\'existe pas<br> */<br>');
        print('function find'.$nomDAO.'($id){<br>');
        print('    global $em;<br><br>');
        print('    $'.strtolower($nomDAO).' = $em->getRepository("'.$nomDAO.'")->find($id);<br><br>');
        print('    return $'.strtolower($nomDAO).';<br>');
        print('}<br><br>');

        // Fonction de recherche de tous les objets de la BDD
        print('/*<br> * @return la liste de tous les '.strtolower($nomDAO).' de la base de données<br> */<br>');
        print('function findAll'.$nomDAO.'(){<br>');
        print('    global $em;<br><br>');
        print('    $all'.$nomDAO.' = $em->getRepository("'.$nomDAO.'")->findAll();<br><br>');
        print('    return $all'.$nomDAO.';<br>');
        print('}<br><br>');

        // Fonction de recherche d'un objet
        print('/*<br> * @param l\'id du '.strtolower($nomDAO).' à supprimer<br> */<br>');
        print('function remove'.$nomDAO.'($id){<br>');
        print('    global $em;<br><br>');
        print('    $'.strtolower($nomDAO).' = $em->getReference("'.$nomDAO.'", $id);<br><br>');
        print('    $em->remove($'.strtolower($nomDAO).');<br>');
        print('    $em->flush();<br>');
        print('}');

        print('</pre>');

        // Tests de la nouvelle DAO
        print('<h2>Tests DAO générée : </h2>');
        print('<pre>');

        print('/////////////////<br>');
        print('// DAO '.$nomDAO.' //<br>');
        print('/////////////////<br><br>');

        // Test recherche par id
        print('print("hr");<br>');
        print('print("h1Test DAO '.strtolower($nomDAO).':h1");<br>');
        print('$'.strtolower($nomDAO).'Existe = find'.$nomDAO.'(numId);<br>');
        print('print("h2Recherche du '.$nomDAO.' (ID: numId)h2");<br>');
        print('print("'.$nomDAO.' trouvé avec l\'ID : ".$'.strtolower($nomDAO).'Existe->getId()."...");<br><br>');
        
        // Test rechercher tout
        print('$all'.$nomDAO.' = findAll'.$nomDAO.'();<br>');
        print('print("h2Recherche de tous les '.strtolower($nomDAO).'h2");<br>');
        print('print(count($all'.$nomDAO.')." '.strtolower($nomDAO).' trouvés");<br><br>');
        
        // Test création
        print('print("h2Création d\'un '.strtolower($nomDAO).'h2");<br>');
        print('getParams...<br>');
        print('$new'.$nomDAO.'Id = create'.$nomDAO.'(params...);<br>');
        print('print("h3'.$nomDAO.' crééh3");<br>');
        print('$new'.$nomDAO.' = find'.$nomDAO.'($new'.$nomDAO.'Id);<br>');
        print('print("'.$nomDAO.' créé avec l\'ID : ".$new'.$nomDAO.'->getId()."...");<br><br>');
        
        // Test suppression
        print('print("h2Suppression du '.strtolower($nomDAO).'h2");<br>');
        print('remove'.$nomDAO.'($new'.$nomDAO.'Id);<br>');
        print('$new'.$nomDAO.' = find'.$nomDAO.'($new'.$nomDAO.'Id);<br>');
        print('if($new'.$nomDAO.' === null){<br>');
        print('    print("h3Aucun '.strtolower($nomDAO).' trouvé avec l\'id ".$new'.$nomDAO.'Id."h3");<br>');
        print('}');

        print('</pre>');
    }
?>