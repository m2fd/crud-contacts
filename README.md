# crud-contacts


A Symfony project created on January 15, 2016, 2:13 pm.

##Instructions

Créez un carnet d'adresse sous forme d'application web à l'aide du framework Symfony 3 et/ou de du framework API Platform.

Il s'agit de réaliser une application de type CRUD (Create-Retrieve-Update-Delete) comprenant les fonctionnalités suivantes :

    Liste de tous les contacts
    Création d'un nouveau contact
    Mise à jour d'un contact existant
    Suppression d'un contact
    La validation des données entrées pas l'utilisateur

Un contact content au minimum les données suivantes :

    nom (obligatoire)
    prénom
    société
    adresse complète
    numéro de téléphone
    email (doit être un email valide)
    site internet (doit être une URL valide)
    particulier ou pro

L'application devra utiliser le paradigme orienté objet.

L'application pourra utiliser le système de persistence de votre choix (SGBD relationnel ; ou encore MongoDB).

L'application devra :

    Respecter le patron de conception Model-View-Controller (MVC)
    Utiliser tant que possible les fonctionnalités introduites avec PHP-7 (scalar type hint, return type, nouveaux opérateurs)
    Respecter les conventions PSR-4, PSR-1 et PSR-2
    Disposer d'une PHPdoc de qualité
    La liste devra être paginée
    Envoyer un email à l'administrateur du site lorsqu'un nouveau contact est ajouté (attention au respect de MVC !)
    M'être rendue sous la forme d'un dépôt Git hébergé sur GitHub, BitBucket ou GitLab (gratuits)

L'implémentation des fonctionnalités suivantes sera un plus :

    Système d'authentification utilisateur utilisant le composant Security de Symfony ou Guard
    Utiliser AJAX (avec votre framework JavaScript préféré) en lieu et places des formulaires Symfony traditionnels

Note : ni la qualité technique ni l'aspect graphique de la partie front (HTML, CSS, JS) ne sera prise en compte dans la notation... Pas la peine d'y passer du temps.

