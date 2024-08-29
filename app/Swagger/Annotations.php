<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Api Laboratorio Referencial de la Direccion de Redes Integradas de Salud Lima Norte.",
 *     version="1.0.0",
 *     description="La API Laboratorio Referencial de la Dirección de Redes Integradas de Salud Lima Norte proporciona una interfaz de programación para acceder y gestionar información relacionada con los exámenes de laboratorio en el sistema de salud. Esta API permite a los desarrolladores interactuar con los datos de los exámenes, incluyendo su obtención, creación, actualización y eliminación.",
 *     @OA\Contact(
 *         email="kevin.huayhuas@gmail.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Utiliza un token JWT para la autenticación"
 * )
 */
class Annotations
{
    // No es necesario añadir código aquí
}
