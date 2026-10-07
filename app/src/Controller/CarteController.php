<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(): Response
    {
        // Données de démonstration : remplacées par les PointDepot en base
        // (avec leurs coordonnées PostGIS) quand le géocodage sera en place.
        $depots = [
            ['nom' => 'Jardin de Cocagne (démo)', 'categorie' => 'jardin', 'lat' => 48.2990, 'lng' => 6.9600, 'creneau' => 'Lun-ven 9h-17h', 'complet' => false],
            ['nom' => 'Boulangerie du centre', 'categorie' => 'public', 'lat' => 48.2848, 'lng' => 6.9497, 'creneau' => 'Mercredi 16h-19h', 'complet' => false],
            ['nom' => 'Mairie annexe', 'categorie' => 'public', 'lat' => 48.2780, 'lng' => 6.9380, 'creneau' => 'Jeudi 17h-19h', 'complet' => true],
            ['nom' => 'Médiathèque', 'categorie' => 'public', 'lat' => 48.2905, 'lng' => 6.9425, 'creneau' => 'Samedi 10h-12h', 'complet' => false],
            ['nom' => 'CE Usine Vosges', 'categorie' => 'reserve', 'lat' => 48.2705, 'lng' => 6.9655, 'creneau' => 'Vendredi 12h-14h', 'complet' => false, 'mention' => 'Réservé aux salariés de l’entreprise'],
            ['nom' => 'Cantine de l’école', 'categorie' => 'professionnel', 'lat' => 48.2820, 'lng' => 6.9560, 'creneau' => 'Lundi 8h', 'complet' => false],
        ];

        // Cahier des charges § 3.2 : les dépôts professionnels n'apparaissent pas sur la carte publique.
        $depotsPublics = array_values(array_filter(
            $depots,
            static fn (array $depot): bool => 'professionnel' !== $depot['categorie'],
        ));

        return $this->render('carte/index.html.twig', [
            'depots' => $depotsPublics,
        ]);
    }
}
