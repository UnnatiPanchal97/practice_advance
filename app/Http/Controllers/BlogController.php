<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = auth()->user()->blogs;

        return response()->json([
            'success' => true,
            'data' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;

        if (auth()->user()->blogs()->save($blog))
            return response()->json([
                'success' => true,
                'data' => $blog->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Blog not added'
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = auth()->user()->blogs()->find($id);

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $blog->toArray()
        ], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $blog = auth()->user()->blogs()->find($id);

    //     if (!$blog) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Blog not found'
    //         ], 400);
    //     }
    //     return $blog;
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Blog $blog )
    {
        $blog->update($request->all());
        return response([ 'blog' => new BlogResource($blog), 'message' => 'Blog retrieved successfully'], 200);

        /*
         Another method for update

        $blog = auth()->user()->blogs()->find($id);

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found'
            ], 400);
        }

        $updated = $blog->fill($request->all());
        $update=$updated->save();
        // console.log($updated);

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Blog can not be updated'
            ], 500);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = auth()->user()->blogs()->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }

        if ($post->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post can not be deleted'
            ], 500);
        }
    }
    public function showInView(){
        $blog=Blog::latest()->paginate(2);
        return view('blogs.index',compact('blog'))->with('i', (request()->input('page', 1) - 1) * 2);
    }
}
