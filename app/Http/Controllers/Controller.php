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
     *   name="articles",
     *   description="All articles operations"
     * )
     * @SWG\Tag(
     *   name="user",
     *   description="Operations about user",
     * )
     * 
     * @SWG\Tag(
     *   name="institutions",
     *   description="All institution operations"
     * )
     * @SWG\Tag(
     *   name="subjects",
     *   description="All subject operations"
     * )
     * @SWG\Tag(
     *   name="authors",
     *   description="All author operations",
     * )
     */
}
