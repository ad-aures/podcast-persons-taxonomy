# PodcastNamespace

This project fetches data from the podcast namespace.

## Usage

You probably need something like this in your composer.json:
```
"scripts": {
    "post-install-cmd": [
      "@php vendor/podlibre/podcastnamespace/src/TaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-en.json >  app/Language/en/Taxonomy.php",
      "@php vendor/podlibre/podcastnamespace/src/TaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-fr.json >  app/Language/fr/Taxonomy.php",
      "@php vendor/podlibre/podcastnamespace/src/ReversedTaxonomyGenerate.php https://raw.githubusercontent.com/Podcastindex-org/podcast-namespace/main/taxonomy-en.json >  vendor/podlibre/podcastnamespace/src/ReversedTaxonomy.php",
    ]
}
```
