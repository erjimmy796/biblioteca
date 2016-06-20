<?php

namespace App\Http\Controllers\library;

use App\models\booksModel;
use App\models\saleModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class saleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleMode = new saleModel();
        $result = saleModel::paginate(5);
        $response = array(
            "data"          =>  (empty($result->items()) ? null : [ $result->items() ]),
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
         *  error = 2, libro no seleccionado
         *  error = 3, inventario insuficiente
         */
        $error = 0;
        $message = 'Registro agregado';
        $saleModel = new saleModel();
        $booksModel = new booksModel();

        if($request->idLibro == 0  || !$request->idLibro ){
            $error = 2;
        }
        $bookResult = $booksModel::where ( 'id' , '=' , $request->idLibro )->get();
        if($bookResult->inventory < $request->items){
            $error = 3;
            $message = 'Items insuficientes para la venta';
        }
        if($error == 0){
            $saleModel->idLbro      = $request->idLibro;
            $saleModel->price       = $bookResult->price;
            $saleModel->units       = $request->items;
            try{
                $saleModel->save();
            } catch ( Exception $e ){
                $error = 4;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
