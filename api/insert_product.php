<?php
// create_product.php <name>
require_once "bootstrap.php";

$mercury = new Product();
$mercury->setName("Mercure");
$mercury->setDescription("Planète plutôt petite ... Au premier rang ... Planète qui a donné son nom au dieu Mercure dans la mythologie romaine (aka. Hermès dans la mythologie grecque) ... Que dire de plus à part que c'est le feu là bas !");
$mercury->setPrice(499);

$venus = new Product();
$venus->setName("Vénus");
$venus->setDescription("Alors que dire ? Ca ressemble à la Terre mais c'est pas la Terre ... et puis il fait un poil plus chaud que sur Terre, enfin on dit ça, on dit rien.");
$venus->setPrice(699);

$earth = new Product();
$earth->setName("Terre");
$earth->setDescription("Eh bien, tu es dessus actuellement. On nous annonce du beau temps pour demain ... et pour acquérir une parcelle sur Terre, il y a bien plus efficace. Essayez une agence immobilière par exemple.");
$earth->setPrice(1299);

$mars = new Product();
$mars->setName("Mars");
$mars->setDescription("Peut-être qu'on s'installera dessus un jour. En tout cas, c'est le bon plan d'acquisition. Et puis la thématique est intéressante, Mars c'est le dieu de la guerre (Arès chez les grecques).");
$mars->setPrice(799);

$jupiter = new Product();
$jupiter->setName("Jupiter");
$jupiter->setDescription("C'est la plus grosse planète du système solaire. Elle est composée de gaz. Voilà voilà. Sinon la thématique pour les romains c'était le ciel, la lumière et les éclairs pour celle là. On l'appelle Zeus chez les grecques. Le Dieu des dieux quoi.");
$jupiter->setPrice(2099);

$saturn = new Product();
$saturn->setName("Saturne");
$saturn->setDescription("Deuxième plus grosse planète en taille et masse derrière Jupiter. C'est aussi la planète la plus entourée avec 82 satellites et son anneau. Faites attention quand vous passez par là bas, il n'y a pas de temps à perdre ... Qu'est-ce que j'ai dit ... Allez on bouge, il va nous rattraper !");
$saturn->setPrice(1899);

$uranus = new Product();
$uranus->setName("Uranus");
$uranus->setDescription("On nous a raconté qu'il y avait beaucoup de glace par là bas. Après c'est une planète gazeuse aussi donc c'était un peu compliqué d'aller vérifier par nos propres moyens. Puis sinon c'est le père à Cronos (Saturne) et le grand-père à Zeus (Jupiter).");
$uranus->setPrice(1699);

$neptune = new Product();
$neptune->setName("Netpune");
$neptune->setDescription("Elle est bleue et puis elle est belle ! Après, on a pas pu l'observer directement, on l'a découvert par déduction. Intéressant non ? Et puis, elle représente le dieu de la mer chez les romains (Poséidon chez les grecques) ... pas étonnant vu sa couleur.");
$neptune->setPrice(1799);

$pluto = new Product();
$pluto->setName("Pluton");
$pluto->setDescription("Est-ce que c'est vraiment une planète ? Oui, non ? Nous, on veut pas se prononcer sur des débats aussi épineux.");
$pluto->setPrice(3);

$entityManager->persist($mercury);
$entityManager->persist($venus);
$entityManager->persist($earth);
$entityManager->persist($mars);
$entityManager->persist($jupiter);
$entityManager->persist($saturn);
$entityManager->persist($uranus);
$entityManager->persist($neptune);
$entityManager->persist($pluto);
$entityManager->flush();