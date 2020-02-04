<?php

namespace App\Http\Controllers;

use App\Dropbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DropboxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }

    public function index()
    {
        $dropboxs = Dropbox::all();

        return view('backend.dropbox.index', ['dropboxs'=>$dropboxs]);
    }

    public function create()
    {
        return view('backend');
    }

    public function store(Request $request)
    {
        try {
            if($request->hasFile('file')){
                $files = $request->file('file');

                foreach ($files as $file) {
                    $fileExtension = $file->getClientOriginalExtension();
                    $mimeType = $file->getClientMimeType();
                    $fileSize = $file->getClientSize();
                    $name = uniqid().'.'.$fileExtension;

                    Storage::disk('dropbox')->putFileAs('public/upload',$file,$name);
                    $this->dropbox->createSharedLinkWithSettings('public/upload/'.$name);

                    Dropbox::create([
                        'file_title' => $name,
                        'file_type'  => $mimeType,
                        'file_size'  => $fileSize 
                    ]);
                }
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($fileTitle)
    {
        try {
            $link       = $this->dropbox->listSharedLinks('public/upload/'.$fileTitle);
            $raw        = explode("?",$link[0]['url']);
            $path       = $raw[0].'?raw=1';
            $tempPath   = tempnam(\sys_get_temp_dir(),$path);
            $copy       = copy($path,$tempPath);

            return response()->file($tempPath);

        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        try {
            $file = Dropbox::find($id);
            Storage::disk('dropbox')->delete('public/upload/'.$file->file_title);
            $file->delete();

            return redirect()->route('dropbox.index');
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function download($fileTitle){
        try {
            return Storage::disk('dropbox')->download('public/upload/'.$fileTitle);
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
