#!/usr/bin/php
<?php
/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

function slug($str, $delimiter = '_')
{
    return trim(
        preg_replace(
            '/[\s-]+/',
            $delimiter,
            preg_replace(
                '/[^a-z0-9_]+/',
                $delimiter,
                preg_replace(
                    '/[&]/',
                    'and',
                    preg_replace('/[\']/', '', strtolower($str))
                )
            )
        ),
        $delimiter
    );
}

/**
* PHP var_export() with short array syntax (square brackets) indented 2 spaces.
*
* NOTE: The only issue is when a string value has `=>\n[`, it will get converted to `=> [`
* @link https://www.php.net/manual/en/function.var-export.php
*/
function varexport($expression, $return=FALSE) {
    $export = var_export($expression, TRUE);
    $patterns = [
        "/array \(/" => '[',
        "/^([ ]*)\)(,?)$/m" => '$1]$2',
        "/=>[ ]?\n[ ]+\[/" => '=> [',
        "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
    ];
    $export = preg_replace(array_keys($patterns), array_values($patterns), $export);
    if ((bool)$return) return $export; else echo $export;
}

if ($argc != 2) {
    echo "Syntax: php TaxonomyGenerate.php JsonUrl\n";
    die();
}

$taxonomy = json_decode(file_get_contents($argv[1]), true);

$group = null;
$taxonomy_array = [];
foreach ($taxonomy as $line) {
    $newgroup = slug(substr($line['key'], 0, strpos($line['key'], '/')));
    if ($group !== $newgroup) {
        $group = $newgroup;
        $taxonomy_array[$line['group']] = ['slug' => $group];
    }
    $role = slug(substr($line['key'], strpos($line['key'], '/') + 1));
    $taxonomy_array[$line['group']]['roles'][$line['role']] = ['slug' => $role];
}

// autogenerate database
print <<<EOT
<?php

/**
 * @copyright  2022 AdAures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */


EOT;
print '/* Autogenerated from ' . $argv[1] . ' on ' . date('c') . " */\n\n";

print "namespace AdAures\PodcastNamespace;\n\n";
print "class ReversedTaxonomy {\n";

print "\tpublic static \$taxonomy = ";
print varexport($taxonomy_array, true);
print ";\n";
print "}\n";

