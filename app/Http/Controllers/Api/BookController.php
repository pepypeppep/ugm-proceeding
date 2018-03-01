<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\Books;
use App\Http\Resources\BooksCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{   
        /**
        * @SWG\Get(
        *     path="/books/",
        *     summary="Get all books",
        *     description="Return collection of books",
        *     operationId="getAllProceedings",
        *     tags={"books"},
        *     produces={"application/json"},
        *     @SWG\Response(
        *         response=200,
        *         description="successful operation"
        *     ),
        *     security={{"Bearer":{}}}
        * )
        */
    public function index(Book $book)
    {
        return new BooksCollection($book->paginate(10));
    }

    /**
    * @SWG\Get(
    *     path="/books/{bookId}",
    *     summary="Get book by ID",
    *     description="Return single record of book",
    *     operationId="getProceedingById",
    *     tags={"books"},
    *     produces={"application/json"},
    *     @SWG\Parameter(
     *         description="ID of book to return",
     *         in="path",
     *         name="bookId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
    *     @SWG\Response(
    *         response=200,
    *         description="successful operation"
    *     ),
    *     security={{"Bearer":{}}}
    * )
    */
    public function show(Book $book)
    {
        return new Books($book);
    }

    public function showFile(Book $book)
    {
        if (Storage::disk('local')->exists($book->file)) {
            // $path = Storage::disk('local')->get($book->file);
            $path = storage_path("app/$book->file");
            // $headers = array('Content-Type: application/pdf');
            return response()->download($path);
        }

        return "File doesn't exsist";
    }

    /**
     * @SWG\Post(
     *      path="/books",
     *      tags={"books"},
     *      operationId="createBook",
     *      summary="Create a new Book",
     *      description="",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Book object that needs to be added",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="title", type="string", example="Menuju Negara Maju: Apakah Indonesia bergerak ke arah yang benar?"),
     *              @SWG\Property(property="description", type="string", example="Indonesia termasuk dalam negara 20 besar perekonomian dunia yakni pendapatan Domestik Bruto terbesar ke-16 menggunakan standar current US$ dan negara dengan total PDB terbesat ke-10 menurut perhitungan alternatif menggunakan Purchasing Power Parity (PPP) (Worldbank, 2013). Indonesia juga telah berhasil keluar dari kelompok negara-negara berpendapatan bawah menjadi negara berpendapatan menengah. Namu, sebagian pakar mengatakan kemungkinan Indonesia masuk dalam jebakan pendapatan menengah (middle income trap). Buku ini bertujuan untuk memberikan gambaran tentang perkembangan capaian indikator sosial ekonomi Indonesia untuk melakukan lompatan atau catch up untuk mengejar negara-negara maju."),
     *              @SWG\Property(property="category", type="string", example="Economy"),
     *              @SWG\Property(property="edition", type="integer", example=1),
     *              @SWG\Property(property="pages", type="integer", example=151),
     *              @SWG\Property(property="publication_year", type="integer", example=2015),
     *              @SWG\Property(property="publisher", type="string", example="UGM Press"),
     *          ),      
     *      ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string|max:1000',
            'category' => 'string|max:20',
            'edition' => 'nullable|integer',
            'pages' => 'nullable|integer',
            'publication_year' => 'required',
            'publisher' => 'required|string',
        ]);

        $book = Book::create($data);

        return new Books($book);
    }

    /**
     * @SWG\Post(
     *      path="/books/{bookId}/author",
     *      tags={"books"},
     *      operationId="addBookAuthor",
     *      summary="Add an author to book",
     *      description="",
     *      consumes={"application/json"},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *         description="ID of book to return",
     *         in="path",
     *         name="bookId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Book object that needs to be added",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(property="user_email", type="string", example="ugm.proceeding@mail.com"),
     *          ),      
     *      ),
     *      @SWG\Response(
     *         response=405,
     *         description="Invalid input"
     *      ),
     *      security={{"Bearer":{}}}
     * )
     */
    public function storeAuthor(Request $request, Book $book)
    {
        $request->validate([
            'user_email' => 'required|exists:users,email',
        ]);

        $user = User::where('email', $request->user_email)->first();

        $book->author()->syncWithoutDetaching($user->id);

        return new Books($book);
    }


    public function storeFile(Request $request, Book $book)
    {
        $request->validate([
            'file' => 'mimes:pdf|required',
        ]);

        $book->uploadAndUpdateFile($request->file('file'));

        return new Books($book);
    }
}
