<?
namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = new Message();
        $message->user_id = $user->id;
        $message->message = $request->input('message');
        $message->save();

        event(new MessageSent($user, $message));

        return ['status' => 'Message sent!'];
    }
}