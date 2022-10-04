<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work; // 追加
use App\User; // 追加
use App\Tag;
use App\Comment;
use App\UploadImage;
use App\Uploadcode;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        
        // 認証済みユーザを取得
        // $user = \Auth::user();
        // ユーザの投稿の一覧を作成日時の降順で取得
        // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
        // $works = $user->works()->orderBy('created_at', 'desc')->paginate(10);
        // // タスク一覧を取得
        // $works = Work::all();
        
        
        if (\Auth::check()) {
            $user = \Auth::user();
            $works = Work::orderBy('id', 'desc')->get();
            // $works = Work::orderBy('id', 'desc')->paginate(14);
            
            $top_num = 12;
            $num = count($works);
            
            $data = [
                'user' => $user, 
                'top_num' => $top_num,
                'num' => $num,
                'works' => $works,
            ];
        }
        else{
            $works = Work::orderBy('id', 'desc')->get();
            
            $top_num = 12;
            $num = count($works);
            
            $data = [
                'top_num' => $top_num,
                'num' => $num,
                'works' => $works,
            ];
        }


        // Welcomeビューでそれらを表示
        return view('welcome', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        $work = new Work;
        $user = \Auth::user();
        
        
        // メッセージ作成ビューを表示
        return view('works.create', [
            'work' => $work,
            'user' => $user,
        ]);
    }
    
    
    
     public function confirm(Request $request, User $user)
    {
        $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:255',
            'tag' => 'required|max:20',
            'upload_image.*' => 'required|file|image|mimes:png,jpeg',
            'code.*' => 'required|file|mimes:html,javascript,css'
        ]);
        
        $title = $request->title;
        $description = $request->description;
        $tag = $request->tag;
        
        $public_path = Storage::path('public/');
       $upload_images = $request->upload_image;
    //   dd($upload_images);
       $new_upload_images = [];
         foreach ($upload_images as $upload_image) {
            if($upload_image) {
                $imageName = $upload_image->getClientOriginalName();
                $extension = $upload_image->getClientOriginalExtension();
                $newImageName = pathinfo($imageName, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;
                $upload_image->move($public_path . "/uploads/tmp", $newImageName);
                
                $new_upload_image = "storage/uploads/tmp/" . $newImageName;
                // dd($new_upload_image);
                array_push($new_upload_images, $new_upload_image);
    		}
         };
        //  dd($new_upload_images);
        
        $user = \Auth::user();
        
        return view('works.confirm', [
            'user' => $user,
            'title' => $title,
            'description' => $description,
            'images' => $new_upload_images,
            'newImageName' => $newImageName,
        ]);
        
        //  return redirect()->route('users.show', ['user' => $user->id]);
       
    }

    
    public function store(Request $request, User $user)
    {
         
        $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:255',
            'tag' => 'required|max:20',
            'upload_image.*' => 'required|file|image|mimes:png,jpeg',
            'code.*' => 'required|file|mimes:html,js,txt'
        ]);
        
        $work = $request->user()->works()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        
        
        
         $codes = $request->code;
         
         foreach ($codes as $code) {
             
            if($code) {
                $file_name = $code->getClientOriginalName();
    			//アップロードされ保存する
    			$path_code_tmp = $code->storeAs('/public/codes_tmp',$file_name);
            }
         }
        
        
        
        // $work_title = $request->title;
        // $work_creater = $request->user()->name;
        // dd($work_creater);
        
        //コードファイルのzip化
        $files = glob('/home/ubuntu/environment/original/storage/app/public/codes_tmp/*'); //(1)
        
        $zip = new ZipArchive();
        $zip_name = md5(uniqid(rand(), true));
        $zip_name .= '.zip';
        $zip_path = "/home/ubuntu/environment/original/storage/app/public/zips/$zip_name";
        $zip->open("/home/ubuntu/environment/original/storage/app/public/zips/$zip_name", ZipArchive::CREATE);
        
        foreach($files as $file){

    		$file_info = pathinfo($file);
    		
    		$file_name = $file_info['filename'].'.'.$file_info['extension'];
    
    		$zip->addFile($file, $file_name); //(4)

	}

    	$zip->close();
    
    	if($zip) {
    	    Storage::disk('public')->deleteDirectory('/codes_tmp');
    	}
    	   // dd($exist);
        // return response()->download('/home/ubuntu/environment/original/storage/app/public/test2.zip');
        if($zip){
    				Uploadcode::create([
    				    'work_id' => $work->id,
    					"file_name" => $request->title,
    					"file_path" => $zip_path,
    				]);
    			}
        
        
        
                
                // // ファイルの存在確認関数
                // if (\File::exists($public_all_path)) {
                //     echo "存在します";
                // } else {
                //     echo "$filepath は存在しません";
                // }
               // return response()->download($public_path.'/zips/test2.zip');
    			
    			
        
    
       $upload_images = $request->upload_image;
         foreach ($upload_images as $upload_image) {
            if($upload_image) {
    			//アップロードされた画像を保存する
    			$path = $upload_image->store('uploads','public');
    // 			dd($path);
    // 			dd($upload_image->getClientOriginalName());
    			//画像の保存に成功したらDBに記録する
    			if($path){
    				UploadImage::create([
    				    'work_id' => $work->id,
    					"file_name" => $upload_image->getClientOriginalName(),
    					"file_path" => $path
    				]);
    			}
    		}
         };
         
         
         
        
        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ一-龠]+)/u', $request->tag, $match);
        $tags = [];
        foreach ($match[1] as $tag) {
            Tag::firstOrCreate([
                'work_id' => $work->id,
                'tag' => $tag
                ]);
        };
        $user = \Auth::user();
         return redirect()->route('users.show', ['user' => $user->id]);
       
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   


        // idの値でメッセージを検索して取得
        $work = Work::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $work->loadRelationshipCounts();
        $tags = $work->tags()->get();
        $upload_images = $work->upload_images()->orderBy('id', 'asc')->get();
        $image_num = count($upload_images);
        $codes = $work->codes()->get();
        
        $user_id = $work->user_id;
        $user = User::findOrFail($user_id);
        $comments = $work->comment()->get();
        // $comments->loadRelationshipCounts();
        // dd($comment);
        // 作品詳細ビューでそれを表示
        return view('works.show', [
            'work' => $work,
            'user' => $user,
            'tags' => $tags,
            'images' => $upload_images,
            'image_num' => $image_num,
            'codes' => $codes,
            'comment' => $comments,
        ]);
    }
    
    

    public function search(Request $request)
    {   
        $keywords = $request->keyword;
        $query = Work::query();
        $works = collect([]);
        preg_match_all('/([a-zA-z0-9０-９ぁ-んァ-ヶ一-龠]+)/u', $keywords, $match);
        foreach ($match[1] as $keyword) {
            $work = Work::whereHas('tags', function ($query) use ($keyword) {
                $query->where('tag', 'LIKE', "%{$keyword}%");
            })->get();
            $works = $works->concat($work);
            // dd($works);
        };
        
        // dd($works);
        
            //各workidの抽出
            $work_num = count($works);
            $works_id = [];
            
            //worksを加工して、ダブっているものを削除する
            
            for($i = 0; $i < $work_num; $i++) {
                
                $work_ori = $works[$i];
                $work_id = $work_ori->id;
                
                
                if(in_array($work_id, $works_id)) {
                    unset($works[$i]);
                    
                } else{
                    array_push($works_id,$work_id);
                }
                
            }
            
        
        
        //データの送信
        $data = [];
        
        if (\Auth::check()) {
            $user = \Auth::user();
            
            $top_num = 12;
            $num = count($works);
            
            $data = [
                'user' => $user, 
                'top_num' => $top_num,
                'num' => $num,
                'works' => $works,
                'keywords' => $match[1],
            ];
        }
        else{
    
            
            $top_num = 12;
            $num = count($works);
            
            $data = [
                'top_num' => $top_num,
                'num' => $num,
                'works' => $works,
                'keywords' => $match[1],
            ];
        }


        // Welcomeビューでそれらを表示
        return view('works.search', $data);
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
        $user = \Auth::user();
        // $works = Work::orderBy('id', 'desc')->paginate(100);
        $works = $user->works;
        // idの値で投稿を検索して取得
        $work = \App\Work::findOrFail($id);
       
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $work->user_id) {
            
            
            // 関係するモデルの件数をロード
            $work->loadRelationshipCounts();
            
            
            //codeファイルの取得
            $codes = $work->codes()->get();
            //codeパスの取り出し
            $code_collection = $codes->first();
            $code_info = collect($code_collection);
            $code_path = '';
            
            foreach($code_info as $key => $value) {
                if($key == 'file_path') {
                    $code_path = $value;
                }
            }
           
            $code_filename = basename($code_path);
            
            //画像の取得
            $upload_images = $work->upload_images()->orderBy('id', 'asc')->get();
            // dd(count($upload_images));
            $image_num = count($upload_images);
            
            $image_paths = [];
            
            for($i = 0; $i < $image_num; $i++) {
                // $i += 1;
                $image_info = collect($upload_images[$i]);
                // dd($image_info);
                
                foreach($image_info as $key => $value) {
                  if($key == 'file_path') {
                    array_push($image_paths, $value);
                  }
                }
            }
            
            // 削除
            foreach($image_paths as $image_path) {
               Storage::disk('public')->delete($image_path);
            }
            Storage::disk('public')->delete('/zips/' . $code_filename);
            
            
            $work->delete();
            
            
        }
        
        
        return redirect()->route('users.show', ['user' => $user->id]);
        
    }
    
     /**
     * お気に入り機能の実装
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function favoritings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $favoritings = $user->favoritings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.favoriting', [
            'user' => $user,
            'users' => $favoritings,
        ]);
    }

    public function favoriters($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $favoriters = $user->favoriters()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.favoriters', [
            'user' => $user,
            'users' => $favoriters,
        ]);
    }


    public function download($id)
    {
         
        // idの値でメッセージを検索して取得
        $work = Work::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $work->loadRelationshipCounts();
        
        $codes = $work->codes()->get();
        
        //codeパスの取り出し
        $code_collection = $codes->first();
        $code_info = collect($code_collection);
        $code_path = '';
        
        foreach($code_info as $key => $value) {
            if($key == 'file_path') {
                $code_path = $value;
            }
        }
       
        $code_filename = basename($code_path);
        
        $work_name = $work->title . '.zip';
        return Storage::disk('public')->download('/zips/' . $code_filename, $work_name);
        //ファイルの名前に「/」が入っていると、使用できなくなるのでヴァリデーションが必要
        // dd($code_path);
    }
}
