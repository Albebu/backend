<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Obtener todos los mensajes.
     */
    public function index()
    {
        $messages = Message::with(['sender', 'receiver'])->get();
        return response()->json($messages, 200);
    }

    /**
     * Obtener la conversación entre dos usuarios.
     */
    public function conversation($user1, $user2)
    {
        $messages = Message::where(function ($query) use ($user1, $user2) {
                $query->where('sender_id', $user1)->where('receiver_id', $user2);
            })
            ->orWhere(function ($query) use ($user1, $user2) {
                $query->where('sender_id', $user2)->where('receiver_id', $user1);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        if ($messages->isEmpty()) {
            return response()->json(['message' => 'No conversation found'], 404);
        }

        return response()->json($messages, 200);
    }


    /**
     * Crear un nuevo mensaje.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        // Crear el mensaje
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'is_read' => false
        ]);

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
    }

    /**
     * Mostrar un mensaje específico.
     */
    public function show($id)
    {
        $message = Message::with(['sender', 'receiver'])->find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        return response()->json($message, 200);
    }

    /**
     * Marcar un mensaje como leído.
     */
    public function update(Request $request, $id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $request->validate([
            'is_read' => 'required|boolean',
        ]);

        $message->update([
            'is_read' => $request->is_read
        ]);

        return response()->json([
            'message' => 'Message updated successfully',
            'data' => $message
        ], 200);
    }

    /**
     * Eliminar un mensaje.
     */
    public function destroy($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Message not found'], 404);
        }

        $message->delete();

        return response()->json(['message' => 'Message deleted successfully'], 200);
    }
}
