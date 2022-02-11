# PodcastNamespace

Generate PHP translation files for CodeIgniter4 from the podcast-namespace's Persons Taxonomy json files.

> See: https://github.com/Podcastindex-org/podcast-namespace

## Usage

Install using composer:

```bash
composer install adaures/podcast-namespace
```

You will have to add a `post-install-cmd` script in your composer.json to generate the translations :

```json
"scripts": {
    "post-install-cmd": [
      "@php vendor/adaures/podcast-namespace/src/TaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-en.json > app/Language/en/Taxonomy.php",
      "@php vendor/adaures/podcast-namespace/src/TaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-fr.json > app/Language/fr/Taxonomy.php",
      "@php vendor/adaures/podcast-namespace/src/ReversedTaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-en.json > vendor/adaures/podcast-namespace/src/ReversedTaxonomy.php",
    ]
}
```
