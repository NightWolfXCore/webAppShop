<?php
/* MY english is so bad 
1. Get Info catalog
2. Sort info via variable
3. Group parent and no-parent catalog
4. Template
5. Print template
*/
global $app;
$list = mysqli_query($app->connectionDB, "SELECT * FROM `catalog`");

// Get all catalog Information

function getInfoCat(mysqli_result $list)
{
    $catalog = null;
    while ($row = $list->fetch_assoc()) {
        $catalog[$row["catalog_ID"]] = $row;
    }
    return $catalog;
}

// Sort and group them (английский учить нужно, я знаю) 

function sorting(array $data)
{
    $catalogGrouped = null;
    foreach ($data as $ID => &$node) {
        if (!$node["catalog_Parent"]) {
            $catalogGrouped[$ID] = &$node;
        } else {
            $data[$node["catalog_Parent"]]["catalog_Childs"][$ID] = &$node;
        }
    }
    return $catalogGrouped;
}

$catalog = getInfoCat($list); // Получаем инфу
$tree = sorting($catalog); // Делаем дерево :D

function oneCatalog(array $catalog)
{
    $menu = sprintf('<li><a class="dropdown-item dd-item" href="/catalog?cat=%d">%s</a></li>', (int)$catalog["catalog_ID"], $catalog["catalog_Name"]);
    if (isset($catalog["catalog_Childs"])) {
        $menu .= sprintf('<ul class="dropdown-menu dd-menu">%s</ul>', showAll($catalog["catalog_Childs"]));
    }
    return $menu;
}

function showAll(array $Tree) {
    $string = "";
    foreach ($Tree as $catalog) {
        $string .= oneCatalog($catalog);
    }
    return $string;
}

$catalogMenu = showAll($tree);

echo $catalogMenu;
?>