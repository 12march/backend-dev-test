<?php

namespace App\Http\Controllers;

use App\Invite;
use App\User;
use App\Member;
use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class InviteController extends Controller
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
     * Send the invite by email.
     *
     * @param  Request  $request
     * @return Response
     */
    public function process(Request $request)
    {
        // validate the incoming request data
        $validateData  = $request->validate([
            'email' => 'required',
            'group_id' => 'required'
        ]);

        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        $invite = Invite::create([
            'group_id' => $request->get('group_id'),
            'email' => $request->get('email'),
            'token' => $token
        ]);

        // send the email
        // Mail::to($request->get('email'))->send(new InviteCreated($invite));

        // redirect back where we came from
        return response()->json(['success' => 'Invite sent successfully'], 200);
    }


    /**
     * Send the invite by email.
     *
     * @param  Request  $request
     * @return Response
     */
    public function accept($token)
    {
        $invite = Invite::where('token', $token)->first();

        // Look up the invite
        if (!$invite) {
            //if the invite doesn't exist
            return response()->json(['error' => 'Invite does not exist'], 404);
        }


        // Look up the members
        $user = Member::where('email', $invite->email)->first();
        if($user) {
            //if the user already exist in group
            return response()->json(['error' => 'You are already a member of this group'], 400);
        } else {

            // Use token as user unique id
            $uniqueid = $invite->token;  

            // Add user to group with the details from the invite
            Member::create([
                'email' => $invite->email,
                'unique_id' => $uniqueid ,
                'group_id' => $invite->group_id,
                'user_id'=> 1,
                ]);

            // delete the invite so it can't be used again
            $invite->delete();

            // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

            return response()->json(['data' => 'Invite accepted!'], 200);
        }
    }
}
