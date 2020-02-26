<?php

namespace App\Http\Controllers\Api;

use App\api\ApiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Participant;

class ParticipantController extends Controller
{
    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->participant::with(['user', 'events'])->get();
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
            $participantData = $request->all();
            $this->participant->create($participantData);

            $return = ['msg' => 'Participante criado com sucesso!'];

            return response()->json($return, 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 01), 500);
            }
            return response()->json(ApiError::errorMessage('Erro Interno', 01), 500);
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
        $participant = $this->participant::with(['user', 'events'])->find($id);
        
        if(!$participant){
            return response()->json(ApiError::errorMessage('Participante não encontrado', 04), 404);
        }

        $participant = collect($participant)->except(['user_id']);
        $data = $participant;
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
            $participantData = $request->all();
            $participant = $this->participant->find($id);
            $participant->update($participantData);
            $return = ['msg' => 'Participante atualizado com sucesso!'];

            return response()->json($return, 201);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 02), 500);
            }
            return response()->json(ApiError::errorMessage('Erro Interno', 02), 500);
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

            return response()->json(['msg' => 'Participante ' . $id->name . ' removido com sucesso!'], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 03), 500);
            }
            return response()->json(ApiError::errorMessage('Erro Interno', 03), 500);
        }
    }
}
