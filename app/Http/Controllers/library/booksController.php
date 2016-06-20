<?php

namespace App\Http\Controllers\library;

use App\models\booksModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class booksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booksModel = new booksModel();
        $result = $booksModel::paginate(5);
        $response = array(
            "data"          =>  (empty($result->items()) ? null : $result->items() ),
            "message"       =>  null,
            "error"         =>  null,
            "pagination"    =>  [
                "total"         =>  $result->total(),
                "perPage"       =>  $result->perPage(),
                "currentPage"   =>  $result->currentPage(),
                "lastPage"      =>  $result->lastPage(),
                "path"          =>  $result->resolveCurrentPath(),
                "query"         =>  [
                    "page"      =>  $result->currentPage(),
                    "perPage"   =>  $result->perPage()
                ],
                "pageName"      =>  "page"
            ]
        );
        return json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         *  error = 2, precio null o 0
         *  error = 3, error de insersion
         */
        $error = 0;
        $message = 'Registro agregado';
        $booksModel = new booksModel();

        if($request->price == 0  || !$request->price ){
            $error = 2;
        }
        $repeat = $booksModel::where('reference' , '=' , $request->reference)->count();
        if($repeat > 0){
            $error = 4;
            $message = 'Registro repetido';
        }
        if($error == 0){
            $booksModel->name       = $request->name;
            $booksModel->author     = $request->author;
            $booksModel->reference  = $request->reference;
            $booksModel->year       = $request->year;
            $booksModel->price      = $request->price;
            $booksModel->inventory  = $request->inventory;
            try{
                $booksModel->save();
            } catch ( Exception $e ){
                $error = 3;
                $message = $e;
            }
        }
        $response = array(
            "data"          =>  null,
            "message"       =>  $message,
            "error"         =>  $error,
            "pagination"    =>  null
        );
        return json_encode($response);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $error = null;
        $booksModel = new booksModel();
        $result = $booksModel::where ( 'id' , '=' , $id )->paginate(1);
        $response = array(
            "data"          =>  (empty($result->items()) ? null : [ $result->items() ]),
            "message"       =>  ($result->total() > 0 ? null : 'Book no found'),
            "error"         =>  ($result->total() > 0 ? 0 : 1),
            "pagination"    =>  [
                "total"         =>  $result->total(),
                "perPage"       =>  $result->perPage(),
                "currentPage"   =>  $result->currentPage(),
                "lastPage"      =>  $result->lastPage(),
                "path"          =>  $result->resolveCurrentPath(),
                "query"         =>  [
                    "page"      =>  $result->currentPage(),
                    "perPage"   =>  $result->perPage()
                ],
                "pageName"      =>  "page"
            ]
        );
        return json_encode($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booksModel = new booksModel();
        /*
         *  error = 2, precio null o 0
         *  error = 3, error de insersion
         */
        $error = 0;
        $message = 'Registro actualizado';
        $booksModel = new booksModel();

        if($request->price == 0  || !$request->price ){
            $error = 2;
        }
        if($error == 0){
            $booksModel->where('id', $id)
                ->update([
                    'name'       => $request->name,
                    'author'     => $request->author,
                    'reference'  => $request->reference,
                    'year'       => $request->year,
                    'price'      => $request->price,
                    'inventory'  => $request->inventory
                ]);
        }
        $response = array(
            "data"          =>  null,
            "message"       =>  $message,
            "error"         =>  $error,
            "pagination"    =>  null
        );
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booksModel = new booksModel();
        /*
         *  error = 2, precio null o 0
         *  error = 3, error de insersion
         */
        $error = 0;
        $message = 'Registro eliminado';
        $booksModel = new booksModel();
        $booksModel->destroy($id);
        $response = array(
            "data"          =>  null,
            "message"       =>  $message,
            "error"         =>  $error,
            "pagination"    =>  null
        );
        return json_encode($response);
    }
}
