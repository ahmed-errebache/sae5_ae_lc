<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class CommandeForm
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public ?string $panier = null;

    #[LiveProp(writable: true)]
    public string $frequence = 'hebdo';

    #[LiveProp(writable: true)]
    public ?string $depot = null;

    // Données provisoires : remplacées par Doctrine quand les entités seront mergées
    public function getPaniers(): array
    {
        return [
            'petit' => ['nom' => 'Petit panier', 'prix' => 12.0],
            'grand' => ['nom' => 'Grand panier', 'prix' => 18.0],
        ];
    }

    public function getFrequences(): array
    {
        return [
            'hebdo'     => ['label' => 'Chaque semaine',        'parMois' => 4],
            'bimensuel' => ['label' => 'Toutes les 2 semaines', 'parMois' => 2],
            'mensuel'   => ['label' => 'Chaque mois',           'parMois' => 1],
        ];
    }

    public function getDepots(): array
    {
        return [
            'boulangerie' => ['nom' => 'Boulangerie du centre', 'categorie' => 'public',  'places' => 5, 'creneau' => 'Mercredi 16h-19h'],
            'mairie'      => ['nom' => 'Mairie annexe',         'categorie' => 'public',  'places' => 0, 'creneau' => 'Jeudi 17h-19h'],
            'ce-usine'    => ['nom' => 'CE Usine Vosges',       'categorie' => 'reserve', 'places' => 8, 'creneau' => 'Vendredi 12h-14h',
                              'mention' => 'Réservé aux salariés de l’entreprise'],
        ];
    }

    public function getPrixMensuel(): ?float
    {
        if ($this->panier === null) {
            return null;
        }

        return $this->getPaniers()[$this->panier]['prix']
             * $this->getFrequences()[$this->frequence]['parMois'];
    }

    public function isComplet(): bool
    {
        return $this->panier !== null && $this->depot !== null;
    }
}
