CREATE VIEW v_serenitea_farms_salaires AS
SELECT
    sfc.id_ceuilleur
    sfhs.montant AS salaire
FROM
    serenitea_farms_ceuilleurs sfc
JOIN 
    serenitea_farms_historique_salaire sfhs
    ON sfc.id_ceuilleur = sfhs.id_ceuilleur
JOIN
    (
        SELECT
            id_ceuilleur,
            montant
        FROM
            serenitea_farms_historique_salaire
        GROUP BY
            id_ceuilleur
    ) AS recent_salary rs
ON
    sfc.id_ceuilleur = rs.id_ceuilleur;

SELECT DISTINCT
    sfd.nom
FROM
    serenitea_farms_depenses sfd
GROUP BY
    sfd.nom;

CREATE VIEW v_serenitea_farms_paiements AS
SELECT
    sfc.nom,
    sfc.prenom,
    sfp.poids,
    sfpmbm.bonus,
    
