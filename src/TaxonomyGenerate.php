#!/usr/bin/php
<?php
/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://podlibre.org/
 */


function slug($str, $delimiter = '_'){

    return strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9_]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));

}


if($argc!=2) {
	echo "Syntax: php TaxonomyGenerate.php JsonUrl\n";
	die();
}

$taxonomy = json_decode(file_get_contents($argv[1]), true);

$group = null;
$taxonomy_array=[];
foreach($taxonomy as $line) {
	$newgroup=slug(substr($line['key'],0,strpos($line['key'],'/')));
	if($group!=$newgroup) {
		$group=$newgroup;
		$taxonomy_array[$group]=['label' => $line['group']];
	}
	$role=slug(substr($line['key'],strpos($line['key'],'/')+1));
	$taxonomy_array[$group]['roles'][$role]=['label' => $line['role'],'description' => $line['description'],'example' => $line['example']];
}

// autogenerate database
print <<<EOT
<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://podlibre.org/
 */


EOT;
print '/* Autogenerated from '.$argv[1].' on '.date('c')." */\n\n";

print "return ";
print var_export($taxonomy_array,true);
print ";\n";
