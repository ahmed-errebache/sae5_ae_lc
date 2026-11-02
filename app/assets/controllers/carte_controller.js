import { Controller } from '@hotwired/stimulus';
import L from 'leaflet';
import 'leaflet/dist/leaflet.min.css';

const COULEURS = {
    jardin: '#16301F',
    public: '#2E6FA8',
    reserve: '#E08A2E',
};

/*
 * Carte des points de dépôt (Leaflet).
 * Prototype : tuiles publiques d'OpenStreetMap, à remplacer en production
 * par un serveur de tuiles dédié (politique d'usage du serveur public).
 */
export default class extends Controller {
    static values = { depots: Array };

    connect() {
        this.map = L.map(this.element);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; contributeurs OpenStreetMap',
        }).addTo(this.map);

        const points = this.depotsValue.map((depot) => {
            L.circleMarker([depot.lat, depot.lng], {
                radius: depot.categorie === 'jardin' ? 13 : 10,
                color: '#ffffff',
                weight: 3,
                fillColor: COULEURS[depot.categorie] ?? '#666666',
                fillOpacity: 1,
            })
                .addTo(this.map)
                .bindPopup(this.popup(depot));

            return [depot.lat, depot.lng];
        });

        if (points.length > 0) {
            this.map.fitBounds(points, { padding: [40, 40] });
        } else {
            this.map.setView([48.2846, 6.9492], 13);
        }
    }

    disconnect() {
        this.map?.remove();
    }

    popup(depot) {
        const div = document.createElement('div');
        const titre = document.createElement('strong');
        titre.textContent = depot.nom;
        div.append(titre, document.createElement('br'), depot.creneau);
        if (depot.mention) {
            const em = document.createElement('em');
            em.textContent = depot.mention;
            div.append(document.createElement('br'), em);
        }
        if (depot.complet) {
            div.append(document.createElement('br'), 'COMPLET');
        }

        return div;
    }
}
