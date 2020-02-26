<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\api\ApiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->address->all();
        return response()->json($data);
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
        try{
            $addressData = $request->all();
            $this->address->create($addressData);

            $return = ['msg' => 'Endereço criado com sucesso!'];

            return response()->json($return, 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 01), 500);
            }
            return response()->json(ApiError::errorMessage('Erro interno', 01), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = $this->address::with(['events'])->find($id);
        
        if(!$address){
            return response()->json(ApiError::errorMessage('Endereço não encontrado', 04), 404);
        }

        $address = collect($address)->except(['user_id']);
        $data = $address;
        return response()->json($data);
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
        try{
            $addressData = $request->all();
            $address = $this->address->find($id);
            $address->update($addressData);
            $return = 'msg' => 'Endereço atualizado com sucesso!'];

            return response()->json($return, 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 02), 500);
            }
            return response()->json(ApiError::errorMessage('Erro interno', 02), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $id->delete();

            return response()->json(['msg' => 'Endereço: ' . $id->name . ' removido com sucesso!'], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 03), 500);
            }
            return response()->json(ApiError::errorMessage('Erro interno', 03), 500);
        }
    }
}
