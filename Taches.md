# Taches pour le projet Mobile Money: ETU004018 - ETU004068

## 1-Tables nécessaires:

- (ok) Table prefixe:
    - id
    - libelle
    - id_operateur

- (ok) Table type_operation: 
    - id
    - nom_operation

- (ok) Table baremes: 
    - id
    - id_type 
    - valeur_min
    - valeur_max
    - montant

- (ok) Table statut_client: 
    - id
    - libelle

- (ok) Table role:
    - id
    - libelle

- (ok) Table clients:
    - id
    - telephone 
    - id_role 
    - id_statut
    - id_operateur

- (ok) Table operateurs: 
    - id
    - nom
    - mdp
    - id_role

- (ok) Table historique: 
    - id
    - id_client_depart
    - id_type
    - id_client_arriver
    - montant
    - frais
    - date

- (ok) Vue v_historique_type_operation:
    - Table historique
    - Table type_operation

## 2-Pages à creer:
### 2-1-Coté opérateur (ETU004018):
#### a-config_prefix.php:
- (ok) base:
    - Table prefixe

- (ok) fonctions:
    - ajouterPrefixe();
    - supprimerPrefixe();

- (ok) design:
    - formulaire:
        - champs pour le prefixe
        - bouton `ajouter un prefixe`

    - Tableau avec colonne:
        - prefixe
        - bouton modifier
        - bouton supprimer

- (ok) integration:
    - Affichage dynamique du tableau


#### b-types_operation.php:
- (ok) base:
    - Table type_operation
    - Table baremes
    
- (ok) fonctions:
    - ajouterTypeOperation()
    - ajouterbaremes()

- (ok) design:
    - type d'operation:
        - formulaire avec champs:
            - nom de l'operation
            - commission
            - valeur min
            - valeur max
            - montant

- (ok) integration:
    - On ajoute un bouton + sur le formulaire du bareme, ce bouton permet d'ajouter un champs dans le formulaire et on ajoute aussi un bouton - qui permet d'effacer ce champs (Js)

#### c-situation_gain.php:
- base:
    - Table historique
    - Vue v_historique_Type_operation

- fonctions:
    - afficherSituationGain()

- design:
    - Des cards affichant chaque total des gains pour chaque type d'operation de l'operateur

- integration:
    - Les card sont afficher dynamiquement

#### d-situation_clients.php:
- base:
    - 
- fonctions:
- design:
- integration:


### 2-2-Coté client:
#### a-login.php:
- base:
    - 
- fonctions:
- design:
- integration:

#### b-solde.php:
- base:
- fonctions:
- design:
- integration:

#### c-depot.php:
- base:
- fonctions:
- design:
- integration:

#### d-retrait.php:
- base:
- fonctions:
- design:
- integration:

#### e-transfert.php:
- base:
- fonctions:
- design:
- integration:

#### h-historique.php:
- base:
- fonctions:
- design:
- integration: