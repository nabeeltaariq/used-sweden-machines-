<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Common;
use App\News_Image;

class NewsController extends Controller
{
    private $common;

    public function __construct(Common $common)
    {
        $this->common = $common;
    }

    //
    public function Index(){

        return view("admin.news_home",["news" => News::all()]);
    }

    public function New(){
        return view("admin.newsForm");
    }

    public function Save(Request $request){
        //Saving File
      $path = $request->file("imageToUpload")->store("products");
      $path = $this->common->SimplifiedPath($path);
      $news = new News();
      $news->news_title = $request->input("newsTitle");
      $newsDate = strtotime($request->input("newsDate"));
      $news->news_date = date('Y-m-d', $newsDate);
      $news->news_des = htmlentities($request->input("description"));
      $news->image = $path;
      $news->save();
        //uploading multiple files
            if($request->file("imagesToUpload") != null){
                foreach($request->file("imagesToUpload") as $image){
                    $path = $image->store("products");
                    $path = $this->common->SimplifiedPath($path);
                    $news_image = new News_Image();
                    $news_image->imageUrl = $path;
                    $news_image->news_id = $news->id;
                    $news_image->save();
                }
            }

        //end of uploading multiple files


      return view("admin.newsForm",["message"=>"News Saved Successfully"]);
    }

    public function RemoveNews($newsId){
        $newsToRemove = News::find($newsId);
        $newsToRemove->delete();
        return redirect("/admin/get/news");
    }

    public function DeleteImages(Request $request){
        foreach($request->imageToDelete as $img){
            $imageToDelete = News_Image::find($img);
            $imageToDelete->delete();
        }

        return back();
    }

    public function EditNews($newsId){
        $news = News::find($newsId);
        $images = News_Image::where("news_id",$news->id)->get();
        return view("admin.editNewsForm",["news" => $news,"images" => $images]);
    }

    public function SaveChanges($id,Request $request){
        $news = News::find($id);
        $news->news_title = $request->input("newsTitle");
        $news->news_date = $request->input("newsDate");
        $news->news_des = htmlentities($request->input("description"));
        if($request->file("imageToUpload") != null){
            $path = $request->file("imageToUpload")->store("products");
            $path = $this->common->SimplifiedPath($path);
            $news->image = $path;
        }

        $news->save();

        if($request->file("imagesToUpload") != null){
            foreach($request->file("imagesToUpload") as $image){
                $path = $image->store("products");
                $path = $this->common->SimplifiedPath($path);
                $news_image = new News_Image();
                $news_image->imageUrl = $path;
                $news_image->news_id = $news->id;
                $news_image->save();
            }
        }


        $images = News_Image::where("news_id",$news->id)->get();
        return view("admin.editNewsForm",["news" => $news,"images" => $images,"message"=>"News Updated Successfully"]);
    }
}
