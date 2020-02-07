<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\api\ApiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['data' => $this->user->all()];
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
            $userData = $request->all();
            $this->user->create($userData);

            $return = ['data' => ['msg' => 'Usuário criado com sucesso!']];

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
        $user = $this->user::with(['events'])->find($id);
        
        if(!$user){
            return response()->json(ApiError::errorMessage('Usuário não encontrado', 04), 404);
        }

        $data = ['data' => $user];
        return response()->json($data);
    }

    /**
     * Display the list of events for a specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allEventsOfUser($id)
    {
        $user = $this->user::with(['events'])->find($id);
        $user = $user->events;
        
        if(!$user){
            return response()->json(ApiError::errorMessage('Usuário não encontrado', 04), 404);
        }

        $data = ['data' => $user];
        return response()->json($data);
    }

    /**
     * Display the event for a specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function singleEventOfUser($user_id, $event_id)
    {
        try{
            $user = $this->user::with(['events'])->find($user_id);
            $event = $user->events->find($event_id);
            $data = ['data' => $event];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1001), 500);
            }
            return response()->json(ApiError::errorMessage('Usuário e Evento não existem ou não estão relacionados', 13), 500);
        }

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
            $userData = $request->all();
            $user = $this->user->find($id);
            $user->update($userData);
            $return = ['data' => ['msg' => 'Usuário atualizado com sucesso!']];

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
    public function destroy(User $id)
    {
        try{
            $id->delete();

            return response()->json(['data' => ['msg' => 'Usuário ' . $id->name . ' removido com sucesso!']], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 03), 500);
            }
            return response()->json(ApiError::errorMessage('Erro interno', 03), 500);
        }
    }
}
