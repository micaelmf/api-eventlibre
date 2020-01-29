<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\api\ApiError;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return response()->json($this->event->paginate(5));
        
        $data = ['data' => $this->event->all()];
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
            $eventData = $request->all();
            $this->event->create($eventData);

            $return = ['data' => ['msg' => 'Evento criado com sucesso!']];

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
        //$event = Event::with('user')->find($id);
        $event = $this->event::with(['user', 'participants', 'sponsors', 'address'])->find($id);
        
        if(!$event){
            return response()->json(ApiError::errorMessage('Evento não encontrado', 04), 404);
        }

        $event = collect($event)->except(['user_id']);
        $data = ['data' => $event];
        return response()->json($data);
    }

    /**
     * Display the list of spopnsors for a specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allSponsorsOfEvent($id)
    {
        $event = $this->event::with(['sponsors'])->find($id);
        $event = $event->sponsors;
        
        if(!$event){
            return response()->json(ApiError::errorMessage('Evento não encontrado', 04), 404);
        }

        $data = ['data' => $event];
        return response()->json($data);
    }

    /**
     * Display the sponsor for a specified event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function singleSponsorOfEvent($event_id, $sponsor_id)
    {
        try{
            $event = $this->event::with(['sponsors'])->find($event_id);
            $sponsor = $event->sponsors->find($sponsor_id);
            $data = ['data' => $sponsor];
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
            $eventData = $request->all();
            $event = $this->event->find($id);
            $event->update($eventData);
            $return = ['data' => ['msg' => 'Evento atualizado com sucesso!']];

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
    public function destroy(Event $id)
    {
        try{
            $id->delete();

            return response()->json(['data' => ['msg' => 'Evento: ' . $id->name . ' removido com sucesso!']], 200);
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 03), 500);
            }
            return response()->json(ApiError::errorMessage('Erro Interno', 03), 500);
        }
    }
}
