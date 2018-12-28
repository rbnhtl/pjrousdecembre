<?php
    /**
	 * @author robin.hortala
	 *
	 */

    include 'coursDAO.php';
    include 'matiereDAO.php';
    include 'etudiantDAO.php';
    include 'departementDAO.php';
    include 'filiereDAO.php';
    include 'groupeDAO.php';
    include 'personnelDAO.php';
    include 'salleDAO.php';
    include 'roleDAO.php';
    include 'abscenceDAO.php';
    include 'animeDAO.php';
    include 'appartientDAO.php';
    include 'occupeDAO.php';
    include 'participeDAO.php';
    include 'remplitDAO.php';

    date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);

    ///////////////
    // DAO Cours //
    ///////////////

    print("<h1>Test DAO cours:</h1>");
    $coursExiste = findCours(11);
    print("<h2>Recherche du cours (ID: 11)</h2>");
    print("Cours trouvé avec l'ID : ".$coursExiste->getId()."<br>Matière : ".$coursExiste->getMatiere()->getLibelle());

    $allCours = findAllCours();
    print("<h2>Recherche de tous les cours</h2>");
    print(count($allCours)." cours trouvés");
    
    print("<h2>Création d'un cours</h2>");
    $matiere = findMatiere(8);
    $dateDeb = new DateTime();
    $dateFin = new DateTime();
    $newCoursId = createCours($matiere, $dateDeb, $dateFin);
    print("<h3>Cours créé</h3>");
    $newCours = findCours($newCoursId);
    print("Cours créé avec l'ID : ".$newCours->getId()."<br>Matière : ".$newCours->getMatiere()->getLibelle());
    
    print("<h2>Surppression du cours</h2>");
    removeCours($newCoursId);
    $newCours = findCours($newCoursId);
    if($newCours === null){
        print("<h3>Aucun cours trouvé avec l'id ".$newCoursId);
    }

    /////////////////
    // DAO Matiere //
    /////////////////

    print("<hr>");
    print("<h1>Test DAO matiere:</h1>");
    $matiereExiste = findMatiere(8);
    print("<h2>Recherche de la Matiere (ID: 8)</h2>");
    print("Matiere trouvée avec l'ID : ".$matiereExiste->getId()."<br>Libelle : ".$matiereExiste->getLibelle());

    $allMatiere = findAllMatiere();
    print("<h2>Recherche de toutes les matieres</h2>");
    print(count($allMatiere)." matieres trouvées");

    print("<h2>Création d'une matiere</h2>");
    $libelle = "matiereTest";
    $newMatiereId = createMatiere($libelle);
    print("<h3>Matiere créée</h3>");
    $newMatiere = findMatiere($newMatiereId);
    print("Matiere créé avec l'ID : ".$newMatiere->getId()."<br>Libelle : ".$newMatiere->getLibelle());

    print("<h2>Suppression de la matiere</h2>");
    removeMatiere($newMatiereId);
    $newMatiere = findMatiere($newMatiereId);
    if($newMatiere === null){
        print("<h3>Aucune matiere trouvée avec l'id ".$newMatiereId."</h3>");
    }
    
    //////////////////
    // DAO Etudiant //
    //////////////////

    print("<hr>");
    print("<h1>Test DAO etudiant:</h1>");
    $etudiantExiste = findEtudiant(1234567891234);
    print("<h2>Recherche du Etudiant (ID: numId)</h2>");
    print("Etudiant trouvé avec l'ID : ".$etudiantExiste->getIne()."<br>Nom : ".$etudiantExiste->getNom()."<br>Prenom : ".$etudiantExiste->getPrenom());

    $allEtudiant = findAllEtudiant();
    print("<h2>Recherche de tous les etudiant</h2>");
    print(count($allEtudiant)." etudiant trouvés");

    print("<h2>Création d'un etudiant</h2>");
    $ine = "2345678912345";
    $nom = "test2";
    $prenom = "test2";
    $newEtudiantIne = createEtudiant($ine, $nom, $prenom);
    print("<h3>Etudiant créé</h3>");
    $newEtudiant = findEtudiant($newEtudiantIne);
    print("Etudiant créé avec l'INE : ".$newEtudiant->getIne()."<br>Nom : ".$etudiantExiste->getNom()."<br>Prenom : ".$etudiantExiste->getPrenom());

    print("<h2>Suppression du etudiant</h2>");
    removeEtudiant($newEtudiantIne);
    $newEtudiant = findEtudiant($newEtudiantIne);
    if($newEtudiant === null){
        print("<h3>Aucun etudiant trouvé avec l'ine ".$newEtudiantIne."</h3>");
    }

    //////////////////
    // DAO Abscence //
    //////////////////

    print("<hr>");
    print("<h1>Test DAO abscence:</h1>");
    $allAbscence = findAllAbscence();
    print("<h2>Recherche de toutes les abscences</h2>");
    print(count($allAbscence)." abscences trouvées");

    print("<h2>Création d'une abscence</h2>");
    $etudiant = findEtudiant(1234567891234);
    $cours = findCours(1);
    $newAbscenceId = createAbscence($etudiant, $cours);
    print("<h3>Abscence créée</h3>");
    $newAbscence = findAbscence($newAbscenceId[0], $newAbscenceId[1]);
    print("Abscence créée pour l'etudiant avec l'INE: ".$newAbscence->getEtud()->getIne()."<br>Cours : ".$newAbscence->getCours()->getId());

    print("<h2>Suppression de l'abscence</h2>");
    removeAbscence($newAbscenceId[0], $newAbscenceId[1]);
    $newAbscence = findAbscence($newAbscenceId[0], $newAbscenceId[1]);
    if($newAbscence === null){
        print("<h3>Aucune abscence trouvée pour l'étudiant : ".$newAbscenceId[0]->getIne()." et le cours ".$newAbscenceId[1]->getId()."</h3>");
    }

    /////////////////////
    // DAO Departement //
    /////////////////////

    print("<hr>");
    print("<h1>Test DAO departement:</h1>");
    $departementExiste = findDepartement(14);
    print("<h2>Recherche du Departement (ID: 14)</h2>");
    print("Departement trouvé avec l'ID : ".$departementExiste->getId()."<br>Libelle : ".$departementExiste->getLibelle());

    $allDepartement = findAllDepartement();
    print("<h2>Recherche de tous les departement</h2>");
    print(count($allDepartement)." departement trouvés");

    print("<h2>Création d'un departement</h2>");
    $id = 16;
    $libelle = "test";
    $newDepartementId = createDepartement($id, $libelle);
    print("<h3>Departement créé</h3>");
    $newDepartement = findDepartement($newDepartementId);
    print("Departement créé avec l'ID : ".$newDepartement->getId()."<br>Libelle : ".$newDepartement->getLibelle());

    print("<h2>Suppression du departement</h2>");
    removeDepartement($newDepartementId);
    $newDepartement = findDepartement($newDepartementId);
    if($newDepartement === null){
        print("<h3>Aucun departement trouvé avec l'id ".$newDepartementId."<h3>");
    }
    
    /////////////////
    // DAO Filiere //
    /////////////////

    print("<hr>");
    print("<h1>Test DAO filiere:</h3>");
    $filiereExiste = findFiliere(1);
    print("<h2>Recherche de la Filiere (ID: 10)</h3>");
    print("Filiere trouvée avec l'ID : ".$filiereExiste->getId()."<br>Departement : ".$filiereExiste->getDepartement()->getId()."<br>Libelle : ".$filiereExiste->getLibelle());

    $allFiliere = findAllFiliere();
    print("<h2>Recherche de toutes les filiere</h3>");
    print(count($allFiliere)." filieres trouvées");

    print("<h2>Création d'une filiere</h3>");
    $departement = findDepartement(14);
    $libelle = "test";
    $administratif = null;
    $newFiliereId = createFiliere($departement, $libelle, $administratif);
    print("<h3>Filiere créée</h3>");
    $newFiliere = findFiliere($newFiliereId);
    print("Filiere créé avec l'ID : ".$newFiliere->getId()."<br>Departement : ".$newFiliere->getDepartement()->getId()."<br>Libelle : ".$newFiliere->getLibelle());

    print("<h2>Suppression de la filiere</h3>");
    removeFiliere($newFiliereId);
    $newFiliere = findFiliere($newFiliereId);
    if($newFiliere === null){
        print("<h3>Aucun filiere trouvée avec l'id ".$newFiliereId."<h3>");
    }

    ////////////////
    // DAO Groupe //
    ////////////////

    print("<hr>");
    print("<h1>Test DAO groupe:</h1>");
    $groupeExiste = findGroupe(231);
    print("<h2>Recherche du Groupe (ID: 231)</h2>");
    print("Groupe trouvé avec l'ID : ".$groupeExiste->getId()."<br>Libelle : ".$groupeExiste->getLibelle()."<br>Filiere : ".$groupeExiste->getFiliere()->getId());

    $allGroupe = findAllGroupe();
    print("<h2>Recherche de tous les groupe</h2>");
    print(count($allGroupe)." groupe trouvés");

    print("<h2>Création d'un groupe</h2>");
    $filiere = findFiliere(1);;
    $libelle = "test";
    $newGroupeId = createGroupe($filiere, $libelle);
    print("<h3>Groupe créé</h3>");
    $newGroupe = findGroupe($newGroupeId);
    print("Groupe créé avec l'ID : ".$newGroupe->getId()."<br>Libelle : ".$groupeExiste->getLibelle()."<br>Filiere : ".$groupeExiste->getFiliere()->getId());

    print("<h2>Suppression du groupe</h2>");
    removeGroupe($newGroupeId);
    $newGroupe = findGroupe($newGroupeId);
    if($newGroupe === null){
        print("<h3>Aucun groupe trouvé avec l'id ".$newGroupeId."<h3>");
    }

    ///////////////////
    // DAO Personnel //
    ///////////////////

    print("<hr>");
    print("<h1>Test DAO personnel:</h1>");
    $personnelExiste = findPersonnel(1);
    print("<h2>Recherche du Personnel (ID: 1)</h2>");
    print("Personnel trouvé avec l'ID : ".$personnelExiste->getId()."<br>Nom : ".$personnelExiste->getNom()."<br>Prenom : ".$personnelExiste->getPrenom()."<br> MDP : ".$personnelExiste->getMdp()."<br> Login : ".$personnelExiste->getLogin());

    $allPersonnel = findAllPersonnel();
    print("<h2>Recherche de tous les personnel</h2>");
    print(count($allPersonnel)." personnel trouvés");

    print("<h2>Création d'un personnel</h2>");
    $login = "test";
    $mdp = "test";
    $nom = "test";
    $prenom = "test";
    $newPersonnelId = createPersonnel($login, $mdp, $nom, $prenom);
    print("<h3>Personnel créé</h3>");
    $newPersonnel = findPersonnel($newPersonnelId);
    print("Personnel créé avec l'ID : ".$newPersonnel->getId()."<br>Nom : ".$personnelExiste->getNom()."<br>Prenom : ".$personnelExiste->getPrenom()."<br> MDP : ".$personnelExiste->getMdp()."<br> Login : ".$personnelExiste->getLogin());

    print("<h2>Suppression du personnel</h2>");
    removePersonnel($newPersonnelId);
    $newPersonnel = findPersonnel($newPersonnelId);
    if($newPersonnel === null){
        print("<h3>Aucun personnel trouvé avec l'id ".$newPersonnelId."</h3>");
    }

    ///////////////
    // DAO Salle //
    ///////////////

    print("<hr>");
    print("<h1>Test DAO salle:</h1>");
    $salleExiste = findSalle('B301');
    print("<h2>Recherche du Salle (NUM: B301)</h2>");
    print("Salle trouvé avec le NUM : ".$salleExiste->getNum()."<br>Description : ".$salleExiste->getDescription());

    $allSalle = findAllSalle();
    print("<h2>Recherche de tous les salles</h2>");
    print(count($allSalle)." salle trouvées");

    print("<h2>Création d'une salle</h2>");
    $num = "C400";
    $description = "test";
    $newSalleNum = createSalle($num, $description);
    print("<h3>Salle créée</h3>");
    $newSalle = findSalle($newSalleNum);
    print("Salle créée avec le NUM : ".$newSalle->getNum()."<br>Description : ".$newSalle->getDescription());

    print("<h2>Suppression du salle</h2>");
    removeSalle($newSalleNum);
    $newSalle = findSalle($newSalleNum);
    if($newSalle === null){
        print("<h3>Aucun salle trouvé avec l'id ".$newSalleNum."<h3>");
    }

    //////////////
    // DAO Role //
    //////////////

    print("<hr>");
    print("<h1>Test DAO role:</h1>");
    $roleExiste = findRole(1);
    print("<h2>Recherche du Role (ID: 1)</h2>");
    print("Role trouvé avec l'ID : ".$roleExiste->getId()."<br>Libelle : ".$roleExiste->getLibelle());

    $allRole = findAllRole();
    print("<h2>Recherche de tous les role</h2>");
    print(count($allRole)." role trouvés");

    print("<h2>Création d'un role</h2>");
    $libelle = "test2";
    $newRoleId = createRole($libelle);
    print("<h3>Role créé</h3>");
    $newRole = findRole($newRoleId);
    print("Role créé avec l'ID : ".$newRole->getId()."<br>Libelle : ".$newRole->getLibelle());

    print("<h2>Suppression du role</h2>");
    removeRole($newRoleId);
    $newRole = findRole($newRoleId);
    if($newRole === null){
        print("<h3>Aucun role trouvé avec l'id ".$newRoleId."<h3>");
    }

    ///////////////
    // DAO Anime //
    ///////////////

    print("<hr>");
    print("<h1>Test DAO anime:</h1>");
    $allAnime = findAllAnime();
    print("<h2>Recherche de tous les anime</h2>");
    print(count($allAnime)." anime trouvés");

    print("<h2>Création d'un anime</h2>");
    $prof = findPersonnel(1);
    $cours = findCours(1);
    $newAnimeId = createAnime($prof, $cours);
    print("<h3>Anime créé</h3>");
    $newAnime = findAnime($newAnimeId[0], $newAnimeId[1]);
    print("Anime créé pour le prof avec l'ID: ".$newAnime->getProf()->getId()."<br>Cours : ".$newAnime->getCours()->getId());

    print("<h2>Suppression de l'anime</h2>");
    removeAnime($newAnimeId[0], $newAnimeId[1]);
    $newAnime = findAnime($newAnimeId[0], $newAnimeId[1]);
    if($newAnime === null){
        print("<h3>Aucune anime trouvé pour le prof : ".$newAnimeId[0]->getId()." et le cours ".$newAnimeId[1]->getId()."</h3>");
    }

    ////////////////////
    // DAO Appartient //
    ////////////////////

    print("<hr>");
    print("<h1>Test DAO appartient:</h1>");
    $allAppartient = findAllAppartient();
    print("<h2>Recherche de tous les appartient</h2>");
    print(count($allAppartient)." appartient trouvés");

    print("<h2>Création d'un appartient</h2>");
    $groupe = findGroupe(231);
    $etudiant = findEtudiant(1234567891234);
    $newAppartientId = createAppartient($groupe, $etudiant);
    print("<h3>Appartient créé</h3>");
    $newAppartient = findAppartient($newAppartientId[0], $newAppartientId[1]);
    print("Appartient créé pour l'étudiant avec l'INE: ".$newAppartient->getEtud()->getIne()."<br>Groupe : ".$newAppartient->getGroupe()->getId());

    print("<h2>Suppression de l'appartient</h2>");
    removeAppartient($newAppartientId[0], $newAppartientId[1]);
    $newAppartient = findAppartient($newAppartientId[0], $newAppartientId[1]);
    if($newAppartient === null){
        print("<h3>Aucun appartient trouvé pour l'étudiant : ".$newAppartientId[1]->getIne()." et le Groupe : ".$newAppartientId[0]->getId()."</h3>");
    }

    ////////////////
    // DAO Occupe //
    ////////////////

    print("<hr>");
    print("<h1>Test DAO occupe:</h1>");
    $allOccupe = findAllOccupe();
    print("<h2>Recherche de tous les occupe</h2>");
    print(count($allOccupe)." occupe trouvés");

    print("<h2>Création d'un occupe</h2>");
    $salle = findSalle("B301");
    $cours = findCours(1);
    $newOccupeId = createOccupe($salle, $cours);
    print("<h3>Occupe créé</h3>");
    $newOccupe = findOccupe($newOccupeId[0], $newOccupeId[1]);
    print("Occupe créé pour la salle: ".$newOccupe->getSalle()->getNum()."<br>Cours : ".$newOccupe->getCours()->getId());

    print("<h2>Suppression de l'occupe</h2>");
    removeOccupe($newOccupeId[0], $newOccupeId[1]);
    $newOccupe = findOccupe($newOccupeId[0], $newOccupeId[1]);
    if($newOccupe === null){
        print("<h3>Aucun occupe trouvé pour le cours : ".$newOccupeId[1]->getId()." et la salle : ".$newOccupeId[0]->getNum()."</h3>");
    }

    ///////////////////
    // DAO Participe //
    ///////////////////

    print("<hr>");
    print("<h1>Test DAO participe:</h1>");
    $allParticipe = findAllParticipe();
    print("<h2>Recherche de tous les objets participe</h2>");
    print(count($allParticipe)." participe trouvés");

    print("<h2>Création d'un objet participe</h2>");
    $groupe = findGroupe(231);
    $cours = findCours(1);
    $newParticipeId = createParticipe($groupe, $cours);
    print("<h3>Participe créé</h3>");
    $newParticipe = findParticipe($newParticipeId[0], $newParticipeId[1]);
    print("Participe créé pour le groupe: ".$newParticipe->getGroupe()->getId()."<br>Cours : ".$newParticipe->getCours()->getId());

    print("<h2>Suppression de participe</h2>");
    removeParticipe($newParticipeId[0], $newParticipeId[1]);
    $newParticipe = findParticipe($newParticipeId[0], $newParticipeId[1]);
    if($newParticipe === null){
        print("<h3>Aucun participe trouvé pour le cours : ".$newParticipeId[1]->getId()." et le groupe : ".$newParticipeId[0]->getId()."</h3>");
    }

    /////////////////
    // DAO Remplit //
    /////////////////

    print("<hr>");
    print("<h1>Test DAO remplit:</h1>");
    $allRemplit = findAllRemplit();
    print("<h2>Recherche de tous les objets remplit</h2>");
    print(count($allRemplit)." remplit trouvés");

    print("<h2>Création d'un objet remplit</h2>");
    $personnel = findPersonnel(1);
    $role = findRole(1);
    $newRemplitId = createRemplit($personnel, $role);
    print("<h3>Remplit créé</h3>");
    $newRemplit = findRemplit($newRemplitId[0], $newRemplitId[1]);
    print("Remplit créé pour le personnel: ".$newRemplit->getPersonnel()->getId()."<br>Role : ".$newRemplit->getRole()->getId());

    print("<h2>Suppression de remplit</h2>");
    removeRemplit($newRemplitId[0], $newRemplitId[1]);
    $newRemplit = findRemplit($newRemplitId[0], $newRemplitId[1]);
    if($newRemplit === null){
        print("<h3>Aucun remplit trouvé pour le personnel : ".$newRemplitId[0]->getId()." et le role : ".$newRemplitId[1]->getId()."</h3>");
    }
?>