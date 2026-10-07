# Matériel du binôme

Le sujet 16-E (IA) demande un GPU pour faire tourner un LLM en local (le sujet cite NVIDIA).

## Ahmed
- CPU : AMD Ryzen 7 8700F (8 cœurs / 16 threads)
- RAM : 16 Go
- GPU : AMD Radeon RX 9060 XT — 16 Go de VRAM
- NVIDIA : non
- Docker Desktop + WSL 2 : OK
- Remarque : 16 Go de VRAM suffisent pour un modèle 7-8B quantifié ; support d'Ollama sur GPU AMD à vérifier

## Lucas
- CPU : Intel Core I9 13900KF (24 coeurs / 32 threads)
- RAM : 64 Go DDR5 6400MHz
- GPU : MSI Geforce RTX 4090 Suprim X - 24 Go de VRAM
- NVIDIA : Oui (pilote 617.14, CUDA 13.4)
- Docker Desktop + WSL 2 : OK
- Remarque : condition NVIDIA du sujet 16-E remplie. Les 24 Go de VRAM permettent de faire tourner un modèle 7-8B très rapidement, ou un modèle jusqu'à ~30B quantifié en 4 bits (contexte plus limité). C'est cette machine qui hébergera Ollama pour le développement et les démos.