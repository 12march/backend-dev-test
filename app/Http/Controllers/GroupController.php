<?php

namespace App\Http\Controllers;

use App\Group;
use App\Member;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Store a new group.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validateData  = $request->validate([
            'admin' => 'required',
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'maximum_capacity' => 'required',
            'group_type' => 'required',
        ]);

        // Create a new group record
        $group = Group::create($validateData);
        
        // return reponse
        return response()->json([
            'status' => 'success',
            'data' => $group
        ], 200);
    }


    /**
     * Show all group that are public
     *
     * @return Response
     */
    public function index()
    {
        $groups = Group::where('group_type', '=', 'public')
            ->get();

        $data = [];
        // Filter response to return
        foreach ($groups as $group) {
            $entry = [
                'name' => $group->name,
                'description' => $group->description,
                'amount' => $group->amount,
                'maximum_capacity' => $group->maximum_capacity,
            ];

            $data[] = $entry;
        }

        // return reponse
        return response()->json(['data' => $data], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $members = Member::where('group_id', '=', $id)->get();
    
        $data = [];
        // Filter response to return
        foreach ($members as $member) {
            $entry = [
                'userName' => $member->user->name,
                'email' => $member->user->email,
                'amount_saved' => $member->amount_saved,
            ];

            $data[] = $entry;
        }
        // return reponse
        return response()->json(['data' => $data], 200);
    }
}
