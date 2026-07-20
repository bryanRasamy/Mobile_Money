# Taches pour le projet Mobile Money: ETU004018 - ETU004068

## 1-Tables nécessaires:

- Table prefixe:
    - id
    - libelle

- Table type_operation: 
    - id
    - nom_operation

- Table baremes: 
    - id
    - id_type 
    - valeur_min
    - valeur_max
    - montant

- Table statut_client: 
    - id
    - libelle

- Table role:
    - id
    - libelle

- Table clients:
    - id
    - telephone 
    - id_role 
    - id_statut

- Table operateurs: 
    - id
    - nom
    - mdp
    - id_role

- Table historique: 
    - id
    - id_client_depart
    - id_type
    - id_client_arriver
    - montant
    - frais
    - date

## 2-Pages à creer:
### 2-1-Coté opérateur:
#### a-config_prefix.php:
- base:
    - Table prefixe

- fonctions:
    - ajouterPrefixe();
    - supprimerPrefixe();
    - modifierPrefixe();

- design:
    - formulaire:
        - champs pour le prefixe
        - bouton `ajouter un prefixe`

    - Tableau avec colonne:
        - prefixe
        - bouton modifier
        - bouton supprimer

- integration:
    - Affichage dynamique du tableau


#### b-types_operation.php:
- base:
    - Table type_operation
    - Table baremes
    
- fonctions:
    - ajouterTypeOperation()
    - ajouterbaremes()

- design:
    - type d'operation:
        - formulaire avec champs:
            - nom de l'operation

    - bareme:
        - formulaire avec champs:
            - valeur min
            - valeur max
            - montant

- integration:
    - On ajoute un bouton + sur le formulaire du bareme, ce bouton permet d'ajouter un champs dans le formulaire et on ajoute aussi un bouton - qui permet d'effacer ce champs (Js)

#### c-situation_gain.php:
- base:
- fonctions:
- design:
- integration:

#### d-situation_clients.php:
- base:
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