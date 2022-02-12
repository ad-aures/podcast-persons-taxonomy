# Podcast Persons Taxonomy

Generate PHP translation files for CodeIgniter4 from the podcast-namespace's Persons Taxonomy json files.

> See: <https://github.com/Podcastindex-org/podcast-namespace>

## Usage

### Install using composer

```bash
composer require adaures/podcast-persons-taxonomy
```

### Generate translations

```bash
# english taxonomy
php src/TaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-en.json > path/to/en/OutputTaxonomy.php
```

```bash
# french taxonomy
php src/TaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-fr.json > path/to/fr/OutputTaxonomy.php
```

### Generate reversed taxonomy

```bash
php src/ReversedTaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-en.json > path/to/OutputReversedTaxonomy.php
```

### Composer.json scripts

You may want to add `post-install-cmd` and `post-update-cmd` scripts to your `composer.json` to generate the translations and reversed taxonomy:

```json
"scripts": {
    "post-install-cmd": [
      "@php vendor/adaures/podcast-persons-taxonomy/src/TaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-en.json > app/Language/en/Taxonomy.php",
      "@php vendor/adaures/podcast-persons-taxonomy/src/TaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-fr.json > app/Language/fr/Taxonomy.php",
      "@php vendor/adaures/podcast-persons-taxonomy/src/ReversedTaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-en.json > vendor/adaures/podcast-namespace/src/ReversedTaxonomy.php",
    ]
}
```
