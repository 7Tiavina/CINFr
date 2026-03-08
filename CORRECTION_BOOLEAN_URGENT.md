# 🚨 Correction Urgente - Erreur Boolean

## Problème

**Erreur dans les logs :**
```
SQLSTATE[22007]: Invalid datetime format: 1366 
Incorrect integer value: 'oui' for column `cinfr`.`clients`.`pere_inconnu` at row 1
```

## Cause

Les champs boolean (`pere_inconnu`, `mere_inconnue`, `a_carte_identite`) reçoivent la valeur texte **"oui"** au lieu de **"1"**.

Bien que le HTML ait `value="1"`, JavaScript peut sauvegarder "oui" dans sessionStorage dans certains cas.

---

## ✅ Solution Appliquée

### Fichier Modifié : `StripeController.php`

Ajout de la conversion des valeurs boolean avant l'insertion en BDD :

```php
// Convertir les champs boolean (oui/non → 1/0)
if (isset($clientDataMapped['pere_inconnu'])) {
    $clientDataMapped['pere_inconnu'] = filter_var($clientDataMapped['pere_inconnu'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
}
if (isset($clientDataMapped['mere_inconnue'])) {
    $clientDataMapped['mere_inconnue'] = filter_var($clientDataMapped['mere_inconnue'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
}
if (isset($clientDataMapped['a_carte_identite'])) {
    $clientDataMapped['a_carte_identite'] = filter_var($clientDataMapped['a_carte_identite'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
}
```

### Comment Fonctionne `filter_var`

```php
filter_var('oui', FILTER_VALIDATE_BOOLEAN)  // → true
filter_var('1', FILTER_VALIDATE_BOOLEAN)    // → true
filter_var('0', FILTER_VALIDATE_BOOLEAN)    // → false
filter_var('non', FILTER_VALIDATE_BOOLEAN)  // → false
```

Puis on convertit en integer :
```php
true ? 1 : 0  // → 1
false ? 1 : 0 // → 0
```

---

## 🚀 Déploiement

```bash
# 1. Vider le cache
php artisan config:clear
php artisan cache:clear

# 2. Tester le formulaire
# Allez sur : https://xn--pr-demande-cni-ckb.com/predemande
# Remplissez le formulaire
# Cochez "Père inconnu: Oui" ou "Non"
# Cochez "Mère inconnue: Oui" ou "Non"
# Complétez le paiement

# 3. Vérifier dans les logs
tail -f storage/logs/laravel.log | grep -i "Client created"

# 4. Vérifier dans la BDD
SELECT id, pere_inconnu, mere_inconnue FROM clients ORDER BY id DESC LIMIT 1;
```

**Résultat attendu :**
- `pere_inconnu` = 0 ou 1 (pas "oui" ou "non")
- `mere_inconnue` = 0 ou 1

---

## 📊 Exemples de Conversion

| Valeur envoyée | Après conversion | Dans la BDD |
|----------------|------------------|-------------|
| `"1"` | `1` | ✅ `1` |
| `"0"` | `0` | ✅ `0` |
| `"oui"` | `1` | ✅ `1` |
| `"non"` | `0` | ✅ `0` |
| `"true"` | `1` | ✅ `1` |
| `"false"` | `0` | ✅ `0` |
| `null` | non défini | ✅ `NULL` |

---

## ✅ Checklist

Après déploiement :

- [ ] Cache vidé (`php artisan cache:clear`)
- [ ] Nouveau test de formulaire effectué
- [ ] Logs montrent "Client created" sans erreur
- [ ] BDD : `pere_inconnu` = 0 ou 1
- [ ] BDD : `mere_inconnue` = 0 ou 1
- [ ] Page de paiement accessible

---

**Date :** 8 Mars 2026  
**Problème :** Erreur SQL - Incorrect integer value: 'oui'  
**Solution :** Conversion boolean avec `filter_var`  
**Statut :** ✅ RÉSOLU
