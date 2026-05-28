<?php
/* MY english is so bad 
1. Get Info category
2. Sort info via variable
3. Group parent and no-parent category
4. Template
5. Print template
*/
global $app;
$list = mysqli_query($app->connectionDB, "SELECT * FROM `category_product`");

// Get all category Information

function getInfoCat(mysqli_result $list)
{
    $category = null;
    while ($row = $list->fetch_assoc()) {
        $category[$row["category_ID"]] = $row;
    }
    return $category;
}

// Sort and group them (английский учить нужно, я знаю) 

function sorting(array $data)
{
    $categoryGrouped = null;
    foreach ($data as $ID => &$node) {
        if (!$node["category_Parent"]) {
            $categoryGrouped[$ID] = &$node;
        } else {
            $data[$node["category_Parent"]]["category_Childs"][$ID] = &$node;
        }
    }
    return $categoryGrouped;
}

$category = getInfoCat($list); // Получаем инфу
$tree = sorting($category); // Делаем дерево :D

function onecategory(array $category)
{
    $menu = sprintf('<li><a class="dropdown-item dd-item" href="/catalog?cat=%d">%s</a></li>', (int)$category["category_ID"], $category["category_Name"]);
    if (isset($category["category_Childs"])) {
        $menu .= sprintf('<ul class="dropdown-menu dd-menu">%s</ul>', showAll($category["category_Childs"]));
    }
    return $menu;
}

function showAll(array $Tree) {
    $string = "";
    foreach ($Tree as $category) {
        $string .= onecategory($category);
    }
    return $string;
}

$categoryMenu = showAll($tree);

echo $categoryMenu;
?>