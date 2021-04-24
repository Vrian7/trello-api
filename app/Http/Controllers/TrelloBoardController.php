<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrelloBoard;
use Illuminate\Support\Facades\Http;

class TrelloBoardController extends Controller
{
    private static $KEY = "key=347653bfa0496e17cc917111e0b8bb1a";
    private static $TOKEN = "token=c4ced814876b97a30d2a3adfa337bc65835c3a6ba5f73dae8ef32a0d9a3013f1";
    private static $PROTOCOL = "https://";
    private static $API =  "api.trello.com/";
    private static $VERSION = '1/';
    private static $LIST_ROUTE = "members/vrian7br/boards";
    private static $STORE_ROUTE = "boards/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 0;
        $endpoint = "https://api.trello.com/1/members/vrian7br/boards?key=347653bfa0496e17cc917111e0b8bb1a&token=c4ced814876b97a30d2a3adfa337bc65835c3a6ba5f73dae8ef32a0d9a3013f1";
        $endpoint =  self::$PROTOCOL.self::$API.self::$VERSION.self::$STORE_ROUTE.'?'.self::$KEY.'&'.self::$TOKEN.'&name=boardDEV2';
        $response = Http::post($endpoint);
        $data = [
            'response' => json_decode($response->getBody(), true)
        ];
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
        $board = new TrelloBoard();
        $board->name = $request->name;
        $board->description = $request->description;
        $board->save();
        $data = [
            'board' => $board
        ];
        return response()->json($board);
    }

    public function syncBoard(Request $request){
        $board = TrelloBoard::find($request->id_board);
        if($board){
            $endpoint =  self::$PROTOCOL.self::$API.self::$VERSION.self::$STORE_ROUTE.'?'.self::$KEY.'&'.self::$TOKEN.'&name='.$board->name;
            $response = Http::post($endpoint);
            $json =  json_decode($response->getBody(), true);
            $board->code = $json['id'];
            $board->save();
            $data = [
                'response' => $json
            ];
        }else{
            $data = [];
        }
        return response()->json($data);

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
