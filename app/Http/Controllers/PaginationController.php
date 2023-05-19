<?php

namespace App\Http\Controllers;
use App\Models\Pagination;
use Faker\Guesser\Name;
use Illuminate\Http\Request;

class PaginationController extends Controller
{
    public function pagination(){
        $user = Pagination::latest()->paginate(5);
        return view('pagination',compact('user'));
    }

    public function insert(Request $request){
        $user = new Pagination();
        $user->Name = $request->name;
        $user->Email = $request->email;
        $user->Password = $request->password;
        $img=[];
        $video=[];
        if($request->file('file')){
            foreach($request->file('file') as $file){
                $typeFile = $file->getClientMimeType();
                $nameTypeFile = substr($typeFile, 0, 5);
                if ($nameTypeFile == "image") {
                    $file_name = time().rand(1,100).'.'.$file->getClientOriginalName();
                    $file->move(public_path('images'), $file_name);  
                    $img[] = $file_name;
                }elseif ($nameTypeFile == "video") {
                    $nameVideo = time() . rand(1, 100) . '-' . $file->getClientOriginalName();
                    $file->move(public_path('videos'), $nameVideo);
                    $video[] = $nameVideo;
			    }
            }
            $img = implode(",", $img); 
            $video = implode(",", $video); 
            $user->Image =$img ;
            $user->Video =$video ;
		}
		$user->save();
		return redirect()->route('pagination.list');
    }

    public function edit($id){

        $user = Pagination::find($id);
        return response()->json([
            'user'=>$user,
        ]);
    }

    public function update(Request $request, $id){
        $user = new Pagination();   
        $user = Pagination::find($id);
        $user->Name = $request->name;
        $user->Email = $request->email;
        $user->Password = $request->password;
        $img=[];
        $video=[];
        if($request->file('files')){
			foreach($request->file('files') as $file)	{
                $typeFile = $file->getClientMimeType();
                $nameTypeFile = substr($typeFile, 0, 5);
                if ($nameTypeFile == "image") {
                    $file_name = time().rand(1,100).'.'.$file->getClientOriginalName();
                    $file->move(public_path('images'), $file_name);  
                    $img[] = $file_name;  
			    }elseif ($nameTypeFile == "video") {
                    $nameVideo = time() . rand(1, 100) . '-' . $file->getClientOriginalName();
                    $file->move(public_path('videos'), $nameVideo);
                    $video[] = $nameVideo;
            }
        }
            $img = implode(",", $img);
            $video = implode(",", $video); 
            $user->Image =$img ;
            $user->Video =$video ;
		}
     
        $user->update();
        return response()->json([
            'message'=>'Users Updated Successfully.'
        ]);
    }

    public function destroy($id)
    {
        $user = Pagination::find($id);
        $user->delete();
        return redirect()->route('pagination.list')->with('status','Deleted Successfully');
    }

    public function paginate()
    {
        $user = Pagination::latest()->paginate(5);
        return view('pagination_view',compact('user'))->render();
    }

    public function search(Request $request){
        $user=Pagination::where('name', 'like', '%'.$request->search.'%')->orWhere('email', 'like', '%'.$request->search.'%')->orderBy('id','desc')->paginate(5);
        if( $user->count() >=1){
            return view('pagination_view',compact('user'))->render();
        }
        return response()->json([
            'status' =>'khong co du lieu tim kiem',
        ]);
    }
}
