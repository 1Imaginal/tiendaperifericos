<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// 1. Ruta absoluta para la conexión a la base de datos
include($_SERVER['DOCUMENT_ROOT'] . "/api-core/conexion.php");

$api_key_secreta = "mi_llave_secreta_v1"; 
$headers = apache_request_headers();

if (!isset($headers['x-api-key']) || $headers['x-api-key'] !== $api_key_secreta) {
    http_response_code(401);
    echo json_encode(["error" => "No autorizado. API Key inválida."]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido. Utiliza POST."]);
    exit();
}

$jsonDatos = file_get_contents("php://input");
$data = json_decode($jsonDatos, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(["error" => "El cuerpo de la petición no es un JSON válido."]);
    exit();
}

$modelo = mysqli_real_escape_string($con, $data['modelo']);
$descripcion = isset($data['descripcion']) ? mysqli_real_escape_string($con, $data['descripcion']) : '';
$idObj = isset($data['idObj']) ? (int)$data['idObj'] : 'NULL';
$idCat = isset($data['idCat']) ? (int)$data['idCat'] : 'NULL';
$precio = isset($data['precio']) ? (float)$data['precio'] : 0.0;
$unidades = isset($data['unidades']) ? (int)$data['unidades'] : 0;

// --- LÓGICA DE DESCARGA DE IMAGEN AUTOMÁTICA ---
$img_url = isset($data['img']) ? $data['img'] : '';
$img_final = 'default.png';

if (filter_var($img_url, FILTER_VALIDATE_URL)) {
    
    $imagen_contenido = @file_get_contents($img_url);
    
    if ($imagen_contenido !== false) {
        $img_final = time() . "_" . uniqid() . ".jpg";
        
        // 2. Ruta absoluta para guardar imágenes en la carpeta del frontend
        $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/rsc/productos/";
        
        // Aseguramos que la carpeta exista
        if (!file_exists($directorioDestino)) {
            mkdir($directorioDestino, 0777, true);
        }
        
        $ruta_destino = $directorioDestino . $img_final;
        file_put_contents($ruta_destino, $imagen_contenido);
    }
} else if ($img_url !== '') {
    $img_final = mysqli_real_escape_string($con, $img_url);
}

// LÓGICA DEL FABRICANTE
$nombreFabricante = isset($data['fabricante']) ? mysqli_real_escape_string($con, trim($data['fabricante'])) : '';
$idFab = 'NULL';

if ($nombreFabricante !== '') {
    $queryFab = "SELECT id FROM fabricante WHERE nombre = '$nombreFabricante'";
    $resFab = mysqli_query($con, $queryFab);
    
    if (mysqli_num_rows($resFab) > 0) {
        $rowFab = mysqli_fetch_array($resFab);
        $idFab = $rowFab['id'];
    } else {
        mysqli_query($con, "INSERT INTO fabricante (nombre) VALUES ('$nombreFabricante')");
        $idFab = mysqli_insert_id($con);
    }
}

// INSERTAR EL PRODUCTO
$query = "INSERT INTO productos (modelo, descripcion, idObj, idFab, idCat, precio, unidades, img) 
          VALUES ('$modelo', '$descripcion', $idObj, $idFab, $idCat, $precio, $unidades, '$img_final')";

if (mysqli_query($con, $query)) {
    http_response_code(201);
    echo json_encode([
        "mensaje" => "Producto guardado con éxito",
        "id_insertado" => mysqli_insert_id($con),
        "fabricante_id" => $idFab
    ]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error de base de datos: " . mysqli_error($con)]);
}

mysqli_close($con);
?>