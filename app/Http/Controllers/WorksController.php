<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work; // 追加
use App\User; // 追加
use App\Tag;
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
            $works = Work::orderBy('id', 'desc')->paginate(100);
            
            $top_num = 9;
            $num = count($works);
            
            $data = [
                'user' => $user, 
                'top_num' => $top_num,
                'num' => $num,
                'works' => $works,
            ];
        }
        else{
            $works = Work::orderBy('id', 'desc')->paginate(100);
            
            $top_num = 9;
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
            'code.*' => 'required|file|mimes:html,javascript,css'
        ]);
        
        $work = $request->user()->works()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        
       $upload_images = $request->upload_image;
         foreach ($upload_images as $upload_image) {
            if($upload_image) {
                // dd($upload_image);
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
         
          $codes = $request->code;
        // dd($request->file('upload_image'));

         foreach ($codes as $code) {
            if($code) {
    			//アップロードされ保存する
    			$path = $code->store('uploads',"public");
    			//画像の保存に成功したらDBに記録する
    			if($path){
    				Uploadcode::create([
    				    'work_id' => $work->id,
    					"file_name" => $code->getClientOriginalName(),
    					"file_path" => $path
    				]);
    			}
    		}
         };
         
        
        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tag, $match);
        // dd($tag);
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
        // $upload_images = $work->upload_images()->get();
        $upload_images = $work->upload_images()->orderBy('id', 'asc')->get();
        $image_num = count($upload_images);
        $codes = $work->codes()->get();
        
        $user_id = $work->user_id;
        $user = User::findOrFail($user_id);
        
        
        // メッセージ詳細ビューでそれを表示
        return view('works.show', [
            'work' => $work,
            'user' => $user,
            'tags' => $tags,
            'images' => $upload_images,
            'image_num' => $image_num,
            'codes' => $codes,
        ]);
    }
    
    // public function __construct()
    // {
    //     $this->authorizeResource(Article::class, "article");
    // }

    public function search(Request $request)
    {   
        
        
        $keyword = $request->keyword;
        $query = Work::query();
        $works = collect([]);
        preg_match_all('/([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $keyword, $match);
        foreach ($match[1] as $keyword) {
            $work = Work::whereHas('tags', function ($query) use ($keyword) {
                $query->where('tag', 'LIKE', "%{$keyword}%");
                // $query->where('tag', 'LIKE', "%{$keyword}%");
            })->get();
            
            $works = $works->concat($work);
            // dd($collapsed->all());
            // array_merge($works, $work);
        };
        
        
        
        // $works = Work::where('title', 'LIKE', "%{$keyword}%")
        //     ->whereHas('tags', function ($query) use ($keyword) {
        //     $query->where('tag', 'LIKE', "%{$keyword}%");
        //     // $query->where('tag', 'LIKE', "%{$keyword}%");
        // })
        // ->get();
        // dd($works);
        // return view("articles.index", ["articles" => $articles, "keyword" => $keyword]);
        
        $data = [];
        
        if (\Auth::check()) {
            $user = \Auth::user();
            
            $top_num = 9;
            $num = count($works);
            
            $data = [
                'user' => $user, 
                'top_num' => $top_num,
                'num' => $num,
                'works' => $works,
                'keyword' => $keyword,
            ];
        }
        else{
    
            
            $top_num = 9;
            $num = count($works);
            
            $data = [
                'top_num' => $top_num,
                'num' => $num,
                'works' => $works,
                'keyword' => $keyword,
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
        $zip = new ZipArchive(); 
        $public_path = Storage::path('public/');
        dd($public_path);
        // dd($public_path);
        // $zip->open(public_path().'/zips/test2.zip', ZipArchive::CREATE);
        $zip->open($public_path.'zips/test2.zip', ZipArchive::CREATE);
        
        foreach ($codes as $code) {
          $code_path = Storage::path('public/' . $code->file_path);
        $code_info = pathinfo($code);
		$code_name = $code_info['filename'].'.'.$code_info['extension'];
        // $zip->addFile($code, $code_name);
        $zip->addFile($public_path . $code->file_path, $code->file_name);
            // return response()->download($code_path, $code->file_name);
        };
        // dd($zip);
        $zip->close();
        // dd('xx');
        // dd($public_path);
        // return response()->download(public_path().'/zips/test2.zip');
        return response()->download($public_path.'zips/test2.zip');
    }
}
