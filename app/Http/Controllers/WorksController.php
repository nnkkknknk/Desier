<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work; // 追加
use App\User; // 追加
use InterventionImage;
use App\Tag;
use App\Comment;
use App\UploadImage;
use App\Uploadcode;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        
        if (\Auth::check()) {
            $user = \Auth::user();
            $works = Work::orderBy('id', 'desc')->paginate(12);
            
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
            $works = Work::orderBy('id', 'desc')->paginate(12);
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
    
    public function store(Request $request, User $user)
    {
         
        $request->validate([
            'title' => 'required|max:32',
            'description' => 'required|max:255',
            'tag' => 'required|max:50',
            'upload_image' => 'required',
            'upload_image.*' => 'required|max:1024|file|image|mimes:png,jpeg,jpg',
            'code' => 'required',
            'code.*' => 'required|mimes:html,javascript,css,txt'
            
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
        if($zip){
    				Uploadcode::create([
    				    'work_id' => $work->id,
    					"file_name" => $request->title,
    					"file_path" => $zip_path,
    				]);
    			}
    
       $upload_images = $request->upload_image;
         foreach ($upload_images as $upload_image) {
            if($upload_image) {
    			//アップロードされた画像を保存する
    			$path = $upload_image->store('uploads','public');
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
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヴー一-龠\-]+)/u', $request->tag, $match);
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
        preg_match_all('/([a-zA-z0-9０-９ぁ-んァ-ヴー一-龠]+)/u', $keywords, $match);
        foreach ($match[1] as $keyword) {
            $work = Work::whereHas('tags', function ($query) use ($keyword) {
                $query->where('tag', 'LIKE', "%{$keyword}%");
            })->get();
            $works = $works->concat($work);
        };
        
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
            $image_num = count($upload_images);
            
            $image_paths = [];
            
            for($i = 0; $i < $image_num; $i++) {
                $image_info = collect($upload_images[$i]);
                
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
        $favoritings = $user->favoritings()->paginate(12);

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
        $favoriters = $user->favoriters()->paginate(12);

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
    }
    
    
    
    public function admindestroy($id)
    {
        // idの値で投稿を検索して取得
        
        $work = \App\Work::findOrFail($id);
       
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (Auth::guard('admin')->user()->admin_level == 1) {
            
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
            $image_num = count($upload_images);
            
            $image_paths = [];
            
            for($i = 0; $i < $image_num; $i++) {
                $image_info = collect($upload_images[$i]);
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
            
            return redirect()->intended('/admin/dashboard'); 
        }
        
        
        
        
    }
}
