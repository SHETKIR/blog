<?php

function dump($data): void {
    echo "<pre>";
    var_dump(value: $data);
    echo "</pre>";
}

function dd($data): never {
    dump(data: $data);
    die();
}

function abort($code = 404): void {
    http_response_code(response_code: $code);
    
    require ERRORS."/{$code}.tmpl.php";
}

function loadPOSTData(array $fillable): array {
    $data = [];
    foreach($_POST as $key=>$value) {
        if(in_array(needle: $key, haystack: $fillable)) {
            $data[$key] = trim(string: $value);
        }
    }
    return $data;
}

function old($fieldname): string
{
    return isset($_POST[$fieldname]) ? h(str: $_POST[$fieldname]) : '';
}

function h($str): string {
    return htmlspecialchars(string: $str, flags: ENT_QUOTES);
}

function stl($str): int {
    return mb_strlen(string: $str, encoding: 'UTF-8');
}

function getAlerts(): void
{
    if(isset($_SESSION['success'])) {
        require_once COMPONENTS.'/alert-success.php';
        unset($_SESSION['success']);
    }
    
    if(isset($_SESSION['error'])) {
        require_once COMPONENTS.'/alert-error.php';
        unset($_SESSION['error']);
    }
    
    if(isset($_SESSION['debug'])) {
        echo '<div class="alert alert-info">' . $_SESSION['debug'] . '</div>';
        unset($_SESSION['debug']);
    }
}

function redirect(string $url): never {
    header("Location: $url");
    exit();
} 