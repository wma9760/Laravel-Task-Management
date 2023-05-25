<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Models\PasswordReset;
use Exception;
use App\Mail\SendCodeResetPassword;
use App\Mail\EmailVerification;

class ContactsController extends NotificationController
{

    /**
     * Verification api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $contacts = User::where('is_admin',0)->get();
        return view('dashboard.Contacts.index', compact('contacts'));
    }
    public function create()
    {
        return view('dashboard.Contacts.create');
    }
    public function edit()
    {
        return view('dashboard.Contacts.update');
    }
    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|max:100',
            'image' => 'required|image',
            'phone' => ['required', 'max:11'],
            'email' => 'required|string|email|max:100|unique:users',
            'location' => 'required|string|max:100',
            'profile' => 'required|string|max:135',

        ]);

        $User = new User();


        if ($req->file('image') != null) {
            $file = $req->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'User' . rand(1, 9999999999) . $req->id . time() . '.' . $extenstion;
            $file->move('assets/images/users', $filename);
            $User->image = $filename;
        }
        $random = Str::random(40);
        $genrate = $req->name . rand(1, 999);
        $User->name = $req->name;
        $User->email = $req->email;
        $User->phone = $req->phone;
        $User->profile = $req->profile;
        $User->location = $req->location;
        $User->api_token = $genrate;
        $User->is_admin = 0;
        $User->password = bcrypt($genrate);
        $User->remember_token=$random;
        $User->save();




        $domain = URL::to('/');
        $url = $domain . '/verify-mail/' . $random;
        $data['url'] = $url;
        $data['email'] = $req->email;
        $data['title'] = 'Verify Email';
        $data['body'] = 'Verify your Email by clicking the link below';

        Mail::to($req->email)->send(new EmailVerification($data, $User));
        $this->sendNotification('User Created','Email has been sent to user for verification');
        return redirect()->route('contact.index');
    }
    public function update(Request $req)
    {
        

        $User = User::find($req->id);


        if ($req->file('image') != null) {
            $file = $req->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = 'User' . rand(1, 9999999999) . $req->id . time() . '.' . $extenstion;
            $file->move('assets/images/users', $filename);
            $User->image = $filename;
        }
        $User->name = $req->name;
        $User->email = $req->email;
        $User->phone = $req->phone;
        $User->profile = $req->profile;
        $User->location = $req->location;
        $User->save();
        
         $this->sendNotification('User Created','Email has been sent to user for verification');
        if(Auth::user()->is_admin==1){
            return redirect()->route('contact.index');
         } 
         else
         {

            return redirect()->route('home');
        }
    }
    public function VerificationMail($token)
    {
        $user = User::where('remember_token', $token)->get();
        if (count($user) > 0) {
            $datetime = date('Y-m-d H:i:s');
            $user = User::find($user[0]['id']);
            $user->remember_token = '';
            $user->email_verified_at = $datetime;
            $user->is_email_verified = 1;
            $user->save();
            $this->sendNotification('Email verified',$user->name.'has verified his/her email');
            return view('auth.email_verified',compact('user'));
        } else {
            return view('errors.404');
        }
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $contacts = User::where('name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
            ->get();
        return view('contacts.index', ['contacts' => $contacts]);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $this->sendNotification('User Deleted',$user->name.'has been deleted');

        return redirect()->route('contact.index');
    }

    public function PasswordReset(Request $req)
    {
        try{
            $user=User::where('email',$req->email)->get();
            if(count($user)>0){
                $token=Str::random(40);
                $domain=URL::to('/');
                $url=$domain.'/reset-password?token=/'.$token;
    
                $data['url']=$url;
                $data['email']=$req->email;
                $data['title']='Reset Password';
                $data['body']='Please Click on the below link to reser password';
                Mail::send('VerificationEmail',['data'=>$data],function($message) use($data){
                    $message->to($data['email'])->subject($data['title']);
                });
                $datetime=date('Y-m-d H:i:s');

                PasswordReset::updateorCreate(
                    ['email'=>$req->email],
                    ['email'=>$req->email,
                    'token'=>$token,
                    'created_at'=>$datetime,
                    
                    ]
                );
                // $user=User::find($user[0]['id']);
                // $user->remember_token=$random;
                // $user->save();
    
                return $this->sendResponse($user, 'Mail Sent Successfuly.');


            }else{
                return $this->sendError('404 Error.',['error'=>'User Not Found']);      

            }

        }
        catch(Exception $e){
            return $this->sendError('Error.', ['error'=>$e->getMessage()]);

        }
    }
public function ForgotPassword(Request $request)
{

    $user=User::where('email',$request->email)->get();
    if(count($user)>0){
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);
     
        // Delete all old code that user send before.
        PasswordReset::where('email', $request->email)->delete();
    
        // Generate random code
        $data['token'] = mt_rand(100000, 999999);
        $datetime=date('Y-m-d H:i:s');
        $data['created_at']=$datetime;
    
        // Create a new code
        $codeData = PasswordReset::create($data);
    
        // Send email to user
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->token));

    }
    return redirect()->route('password.reset');
    

}
public function CodeCheck(Request $request)
{
    // $request->validate([
    //     'token' => 'required|string|exists:password_resets',
    // ]);
  
     $validator = Validator::make($request->all(), [
        'token' => 'required|string|exists:password_resets',
    ]);
  if($validator->fails()){
    return  response([
        'message' => trans('Invalid OTP')
    ], 200);

      
  }

    // find the code
    $passwordReset = PasswordReset::firstWhere('token', $request->token);
    

    // check if it does not expired: the time is one hour
    if ($passwordReset->created_at > now()->addHour()) {
        $passwordReset->delete();
        return response(['message' => trans('Code Expired')], 422);
    }

    return response([
        'otp' => $passwordReset->token,
        'message' => trans('success')
    ], 200);
    
    
}
public function ResetPassword(Request $request)
{
    $request->validate([
        'token' => 'required|string|exists:password_resets',
        'password' => 'required|string|min:4',
        'c_password' => 'required|same:password',

    ]);

    // find the code
    $passwordReset = PasswordReset::firstWhere('token', $request->token);

    // check if it does not expired: the time is one hour
    if ($passwordReset->created_at > now()->addHour()) {
        $passwordReset->delete();
        return response(['message' => trans('passwords.code_is_expire')], 422);
    }

    // find user's email 
    $user = User::firstWhere('email', $passwordReset->email);

    // update user password
    $user->password=bcrypt($request->password);
    $user->update();

    // delete current code 
    $passwordReset->delete();

 return response()->json([
                    "message"=>"success"
                ]);
}
   
    
}
