<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @SWG\Swagger(
     *   basePath="/api",
     *   @SWG\Info(
     *     title="UGM Proceeding API",
     *     version="1.0.0"
     *   )
     * )
     */

    /**
     * @SWG\SecurityScheme(
     *   securityDefinition="Bearer",
     *   type="apiKey",
     *   name="Authorization",
     *   in="header",
     * )
     */

    /**
     * @SWG\Tag(
     *   name="proceedings",
     *   description="All proceeding operations",
     * )
     * @SWG\Tag(
     *   name="store",
     *   description="Access to Petstore orders"
     * )
     * @SWG\Tag(
     *   name="user",
     *   description="Operations about user",
     *   @SWG\ExternalDocumentation(
     *     description="Find out more about our store",
     *     url="http://swagger.io"
     *   )
     * )
     */
}
