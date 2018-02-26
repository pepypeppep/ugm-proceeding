<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\Articles;
use App\Repositories\Api\ArticlesRepository;
use Illuminate\Http\Request;

class IndexationController extends Controller
{   
    /**
     * @SWG\Post(
     *      path="/articles/{articleId}/file",
     *      tags={"articles"},
     *      operationId="updateArticleFile",
     *      summary="Update article file",
     *      description="",
     *      consumes={"multipart/form-data"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         description="Article's id",
     *         format="int64",
     *         in="path",
     *         name="articleId",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="file_type",
     *         in="formData",
     *         description="File type values of the article",
     *         required=true,
     *         type="string",
     *         enum={"pdf", "scopus", "doaj"},
     *         default="pdf"
     *     ),
     *     @SWG\Parameter(
     *         name="file_link",
     *         in="formData",
     *         description="File link value. Required if file type not pdf",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         description="Upload pdf file",
     *         in="formData",
     *         name="file_pdf",
     *         required=false,
     *         type="file"
     *     ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */
    public function update(Article $article, ArticlesRepository $repository, Request $request)
    {
        $request->validate([
            'file_type' => 'required|string',
            'file_link' => 'required_unless:file_type,pdf|string',
            'file_pdf' => 'mimes:pdf|required_if:file_type,pdf',
        ]);

        $repository->updateIndexation($article, $request);

        return new Articles($article);
    }
}
