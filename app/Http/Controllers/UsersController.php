<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加


class UsersController extends Controller
{
    
    public function show($id)
    {
        
        $data = [];
        
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
         // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        $works = $user->works()->orderBy('created_at', 'desc')->paginate(12);
        $favoritings = $user->favoritings()->orderBy('created_at', 'desc')->paginate(12);
        $icon = $user->icon_file_path;
        
        $top_num = 12;
        $num = count($works);
        $data = [
            'user' => $user,
            'works' => $works,
            'favoritings' => $favoritings,
            'icon' => $icon,
            'top_num' => $top_num,
            'num' => $num
    
        ];
         
        return view('users.show', $data);
        
    }
    
      /**
     * プロフィール編集アクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        
        $request->validate([
            'name' => 'required|max:20',
        ]);
        
        
        $self_information = $request->self_information;
        if($self_information) {
             $request->validate([
                'self_information' => 'max:255',
            ]);
            
        }
        
        
        $gender = $request->gender;
        if($gender) {
             $request->validate([
                'gender' => 'integer | between:0,2'
            ]);
            
        }
        
        $year = $request->year;
        if($year) {
             $request->validate([
                'year' => 'integer | between:1922,2022'
            ]);
            
        }
        $month = $request->month;
        if($month) {
             $request->validate([
                'month' => 'integer | between:1,12'
            ]);
            
        }
        $day = $request->day;
        if($day) {
             $request->validate([
                'day' => 'integer | between:1,31'
            ]);
            
        }
        
        $Twitter = $request->Twitter;
        if($Twitter) {
             $request->validate([
                'Twitter' => 'max:30',
            ]);
            
        }
        
        $Instagram = $request->Instagram;
        if($Instagram) {
             $request->validate([
                'Instagram' => 'max:30',
            ]);
            
        }
        
        $Facebook = $request->Facebook;
        if($Facebook) {
             $request->validate([
                'Facebook' => 'max:30',
            ]);
            
        }
        
        
        
        
        
       
        $icon = $request->icon;
    
    
        if($icon) {
            $request->validate([
                'icon' => 'required|file|image|mimes:png,jpeg,jpg',
            ]);
			//アップロードされた画像を保存する
			$path = $icon->store('uploads',"public");
			
			//画像の保存に成功したらDBに記録する
			if($path){
				$user->icon_file_path = $path;
				$user->icon_file_name = $icon->getClientOriginalName();
				
			}
			
		}
		
		
		
		
		$user->name = $request->name;
        $user->self_information = $request->self_information;
        $user->gender = $request->gender;
        $user->year = $request->year;
        $user->month = $request->month;
        $user->day = $request->day;
        $user->Twitter = $request->Twitter;
        $user->Instagram = $request->Instagram;
        $user->Facebook = $request->Facebook;
		$user->save();
    //   dd(asset($path));
    //   https://desire.fly.dev/uploads/9kMA3kcMENnnGrA1vjlSlzsbJJcQtGM3ODllFrZ9.jpg
    //   https://desire.fly.dev/uploads/cyX6hq9rw93OQARhnVOk8UEqqGdcg2rkMC9oxvkP.png
        // echo $path;
        return redirect()->route('users.show', ['user' => $user->id]);
    
    }
    
    public function edit($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // フォロワー一覧ビューでそれらを表示
        return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    
    public function post($id)
    {
        $user = User::findOrFail($id);
        return view('users.post', '$user');
        
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(12);
        
        $works = $user->works()->orderBy('created_at', 'desc')->paginate(12);
        
        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
            'works' => $works,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(12);
        
        $works = $user->works()->orderBy('created_at', 'desc')->paginate(12);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followers,
            'works' => $works,
        ]);
    }
    
    
   
}
