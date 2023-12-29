<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::get();
        return view('admin.videos.video_view', compact('videos'));
    }

    public function add()
    {
        return view('admin.videos.video_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required',
        ]);

        $video = new Video();
        $video->video = $request->video;
        $video->caption = $request->caption;
        $video->save();

        return redirect()->route('admin_video')->with('success', 'Vídeo Adicionado com Sucesso!');
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return view('admin.videos.video_edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'video' => 'nullable',
            'caption' => 'sometimes|required',
        ]);

        // Only update 'video' if it's present in the request
        if ($request->has('video')) {
            $video->video = $request->video;
        }

        $video->caption = $request->caption;
        $video->save();

        return redirect()->route('admin_video')->with('success', 'Vídeo Atualizado com Sucesso!');
    }

    public function activate($id)
    {
        $video = Video::findOrFail($id);
        $video->status = $video->status ? 0 : 1; // Toggle the status (if it's 1, make it 0, and vice versa)
        $video->save();

        if ($video->status) {
            return redirect()->route('admin_video')->with('success', 'Vídeo Ativado com Sucesso!');
        } else {
            return redirect()->route('admin_video')->with('success', 'Vídeo Desativado com Sucesso!');
        }
    }


    public function delete($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin_video')->with('success', 'Vídeo Deletado com Sucesso!');
    }
}
