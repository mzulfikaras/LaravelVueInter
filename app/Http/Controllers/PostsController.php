<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return response([
            'success' => true,
            'message' => 'list semua post',
            'data' => $posts
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required',
        ],
        [
            'title.required' => 'masukan title post !',
            'content.required' => 'masukan content post',
        ]

        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'silahkan isi kolom yang kosong',
                'data' => $validator->errors()
            ], 400);
        } else {
            $post = Post::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'post berhasil disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'post gagal disimpan!',
                ], 400);
            }


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if ($post){
            return response()->json([
                'success' => true,
                'message' => 'detail post!',
                'data' => $post,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'post tidak ditemukan',
                'data' => '',
            ], 404);
        }
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
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required',
        ],
            [ 
                'title.required' => 'masukan title post',
                'content.required' => 'masukan content post',
            ]

        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'silahkan isi kolom yang kosong',
                'data' => $validator->errors()
            ], 400);
        } else {
            $post = Post::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'post berhasil diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'post gagal diupdate!',
                ], 500);
            }


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post -> delete();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'post berhasil dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'post gagal dihapus!',
            ], 500);
        }

        
    }
}
