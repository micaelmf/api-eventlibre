<?php

namespace App\Http\Controllers\Api;

use App\Speaker;
use App\api\ApiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpeakerController extends Controller
{
    public function __construct(Speaker $speaker)
    {
        $this->speaker = $speaker;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->speaker->all();
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
            $speakerData = $request->all();
            $this->speaker->create($speakerData);

            $return = ['msg' => 'Palestrante criado com sucesso!'];

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
        $speaker = $this->speaker::with(['activities', 'events', 'user'])->find($id);
        
        if(!$speaker){
            return response()->json(ApiError::errorMessage('Palestrante não encontrado', 04), 404);
        }

        $speaker = collect($speaker)->except(['user_id']);
        $data = $speaker;
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
            $speakerData = $request->all();
            $speaker = $this->speaker->find($id);
            $speaker->update($speakerData);
            $return = ['msg' => 'Palestrante atualizado com sucesso!'];

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

            return response()->json(['msg' => 'Palestrante: ' . $id->name . ' removido com sucesso!'], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 03), 500);
            }
            return response()->json(ApiError::errorMessage('Erro interno', 03), 500);
        }
    }
}
