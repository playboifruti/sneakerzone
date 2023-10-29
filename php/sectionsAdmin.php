<?php
$section = isset($_GET['section']) ? $_GET['section'] : 'products';

function loadContent($section) {
    global $order, $messages, $products;

    if ($section === 'orders') {
        return $order;
    } elseif ($section === 'messages') {
        return $messages;
    } else {
        return $products;
    }
}

function isSectionActive($currentSection, $sectionName) {
    return $currentSection === $sectionName ? 'active' : '';
}

?>