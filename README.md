Projet Billetterie Louvre
========================
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/167a9ba8-e254-477d-9d9f-09bf915b97a5/big.png)](https://insight.sensiolabs.com/projects/167a9ba8-e254-477d-9d9f-09bf915b97a5)

Bienvenue sur mon projet 4 du parcours CPM-DEV consacré à la billetterie pour le musée du louvre.

https://www.louvre-billetterie.alexandre-drabczuk.fr

Que contient-il?
--------------

Ce projet contient le code source de la billetterie. L'énoncé du sujet était le suivant:

Le musée du Louvre vous a missionné pour un projet ambitieux : créer un nouveau système de réservation et de gestion des tickets en ligne pour diminuer les longues files d’attente et tirer parti de l’usage croissant des smartphones.

L’interface doit être accessible aussi bien sur ordinateur de bureau que tablettes et smartphones, et utiliser pour cela un design responsive.

L’interface doit être fonctionnelle, claire et rapide avant tout. Le client ne souhaite pas surcharger le site d’informations peu utiles : l’objectif est de permettre aux visiteurs d’acheter un billet rapidement.

Il existe 2 types de billets : le billet « Journée » et le billet « Demi-journée » (il ne permet de rentrer qu’à partir de 14h00). Le musée est ouvert tous les jours sauf le mardi (et fermé les 1er mai, 1er novembre et 25 décembre).

Le musée propose plusieurs types de tarifs :

Un tarif « normal » à partir de 12 ans à 16 €
Un tarif « enfant » à partir de 4 ans et jusqu’à 12 ans, à 8 € (l’entrée est gratuite pour les enfants de moins de 4 ans)
Un tarif « senior » à partir de 60 ans pour 12  €
Un tarif « réduit » de 10 € accordé dans certaines conditions (étudiant, employé du musée, d’un service du Ministère de la Culture, militaire…)
Pour commander, on doit sélectionner :

Le jour de la visite
Le type de billet (Journée, Demi-journée…). On peut commander un billet pour le jour même mais on ne peut plus commander de billet « Journée » une fois 14h00 passées.
Le nombre de billets souhaités
Le client précise qu’il n’est pas possible de réserver pour les jours passés (!), les dimanches, les jours fériés et les jours où plus de 1000 billets ont été vendus en tout pour ne pas dépasser la capacité du musée.

Pour chaque billet, l’utilisateur doit indiquer son nom, son prénom, son pays et sa date de naissance. Elle déterminera le tarif du billet.

Si la personne dispose du tarif réduit, elle doit simplement cocher la case « Tarif réduit ». Le site doit indiquer qu’il sera nécessaire de présenter sa carte d’étudiant, militaire ou équivalent lors de l’entrée pour prouver qu’on bénéficie bien du tarif réduit.

Le site récupèrera par ailleurs l’e-mail du visiteur afin de lui envoyer les billets. Il ne nécessitera pas de créer un compte pour commander.

Le visiteur doit pouvoir payer avec la solution Stripe par carte bancaire.

Le site doit gérer le retour du paiement. En cas d’erreur, il invite à recommencer l’opération. Si tout s’est bien passé, la commande est enregistrée et les billets sont envoyés au visiteur.

Vous utiliserez les environnements de test fournis par Stripe pour simuler la transaction, afin de ne pas avoir besoin de rentrer votre propre carte bleue.

Fonctionnalités:
--------------
Achat, paiement, et livraison en ligne de billets pour le musée;

Vérifications formulaires sur les dates, heures, limites de places, et calcule du prix.

Pages statiques procurant des informations au visiteur.

Récupération de commande précédemment passées.

Envoi de mail de confirmation.


