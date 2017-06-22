<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 22/06/2017
 * Time: 09:44
 */

function getTemplate(string $view, array $data = []) {
    // Turn output buffering on
    ob_start();
    // Parse data in variables
    extract($data);
    // Include view file in buffer
    require ROOT_PATH."/src/views/{$view}.php";
    // Get buffer content in a variable
    $content = ob_get_clean();

    return $content;
}

/**
 * Show result of the view
 * @param string $view : view name
 * @param array $data : associative array of data passed to the view
 * @param string $layout : layout
 */
function renderView(
    string $view,
    array $data = [],
    string $layout = 'layout') {

    // Get html code of the view
    $viewContent = getTemplate($view, $data);

    // Add view render to data passed to layout
    $data['content'] = $viewContent;

    // Layout application
    $result = getTemplate($layout, $data);

    echo $result;
}

/**
 * Connection function to database with PDO library
 * @return PDO
 */
function getPDO() {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    return new PDO(
        DSN,
        DB_USER,
        DB_PASS, $options);
}