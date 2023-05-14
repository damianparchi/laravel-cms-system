<?php
namespace App\Http\Controllers;



use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="OpenApi",
 *      description="L5 Swagger OpenApi description",
 * )
 */
class PostController extends Controller
{
    /**
     * Show Post
     * @OA\Get(
     *     path="/admin/post/{post_id}",
     *     tags={"PostController"},
     *     @OA\Parameter(
     *         name="post_id",
     *         in="path",
     *         description="ID of the post to show",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Title"),
     *             @OA\Property(property="post_image", type="string", example="Image URL"),
     *             @OA\Property(property="body", type="string", example="Post body"),
     *             @OA\Property(property="updated_at", type="string", format="datetime", example="2023-05-11T14:34:27.000000Z"),
     *             @OA\Property(property="created_at", type="string", format="datetime", example="2023-05-11T14:34:27.000000Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="Post not found")
     *         )
     *     )
     * )
     */
    public function show($slug)
    {

        $post = Post::where('slug', $slug)->firstOrFail();

        $comments = $post->comments()->where('is_active', 1)->orderBy('created_at', 'desc')->paginate(5);

        if (request()->wantsJson()) {
            return response()->json([
                'post' => $post,
                'comments' => $comments
            ]);
        }

        return view('blog-post', compact('post', 'comments'))
            ->with('noComments', !$comments->count());
    }

    public function create() {
        return view ('admin.posts.create');
    }
    /**
     * Create Post
     * @OA\Post (
     *     path="/admin/posts",
     *     tags={"PostController"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="string",
     *                      property="title",
     *                      description="Post title",
     *                      example="Example title"
     *                 ),
     *                 @OA\Property(
     *                      type="string",
     *                      property="body",
     *                      description="Post body",
     *                      example="Example body"
     *                 ),
     *                 @OA\Property(
     *                      type="file",
     *                      property="post_image",
     *                      description="Post image",
     *                      example="file"
     *                 ),
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Post created successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="user_id", type="integer", example=1),
     *              @OA\Property(property="title", type="string", example="Example title"),
     *              @OA\Property(property="body", type="string", example="Example body"),
     *              @OA\Property(property="post_image", type="string", example="example.jpg"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(property="errors", type="object", example={"title": {"The title field is required."}})
     *          )
     *      )
     * )
     */


    public function store() {

        $inputs = request() -> validate([
            'title' => 'required | min:6 | max:255',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required',
        ]);
        $inputs['slug'] = SlugService::createSlug(Post::class, 'slug', request('title'));
        if(request()->hasFile('post_image')){
            $path = request()->file('post_image')->store('images');

            Artisan::call('storage:link');
            $filename = basename(Storage::url($path));
            $inputs['post_image'] = '/storage/images/' . $filename;


        }


        auth()->user()->posts()->create($inputs);

        Session::flash('post-create-message', 'The post '. '<b>'. $inputs['title'] .'</b>' .' has been added.');

        if(request()->wantsJson()) {
            return response()->json([
                'title' => request('title'),
                'post_image' => request('post_image'),
                'body' => request('body'),
            ]);
        }

        return redirect()->route('post.index');
    }

    public function index() {
        $posts = auth()->user()->userHasRole('Admin') ? Post::paginate(5) : auth()->user()->posts()->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }
    /**
     * Delete Post
     *
     * @OA\Delete(
     *     path="/admin/posts/destroy/{post}",
     *     tags={"PostController"},
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="Post ID",
     *         @OA\Schema(
     *             type="integer",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Post deleted successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Post not found"),
     *         )
     *     )
     * )
     */
    public function destroy(Post $post) {
        $post->delete();

        Session::flash('post-delete-message', "The post ". '<b>'. $post->title .'</b>' ." has been deleted.");

        if(request()->wantsJson()) {
            return response()->json([
                'id' => $post->id,
            ]);

        }

        return back();

    }

    public function edit(Post $post) {

        return view('admin.posts.update', compact('post'));
    }
    /**
     * Update Post
     *
     * @OA\PUT(
     *     path="/admin/posts/update/{post}",
     *     tags={"PostController"},
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         description="ID of post to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="string",
     *                      property="title",
     *                      description="Post title",
     *                      example="Example title"
     *                 ),
     *                 @OA\Property(
     *                      type="string",
     *                      property="body",
     *                      description="Post body",
     *                      example="Example body"
     *                 ),
     *                 @OA\Property(
     *                      type="file",
     *                      property="post_image",
     *                      description="Post image",
     *                      example="file"
     *                 ),
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Post updated successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="user_id", type="integer", example=1),
     *              @OA\Property(property="title", type="string", example="Example title"),
     *              @OA\Property(property="body", type="string", example="Example body"),
     *              @OA\Property(property="post_image", type="string", example="example.jpg"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid input",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(property="errors", type="object", example={"title": {"The title field is required."}})
     *          )
     *      )
     * )
     */
    public function update(Post $post) {
        $inputs = request()->validate([
            'title' => 'required|min:6|max:255',
            'body' => 'required',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (request()->hasFile('post_image')) {
            $path = request()->file('post_image')->store('images');

            Artisan::call('storage:link');
            $filename = basename(Storage::url($path));
            $inputs['post_image'] = '/storage/images/' . $filename;
        }

        $post->update($inputs);
        Session::flash('post-update-message', "The post ". '<b>'. $post->title .'</b>' ." has been deleted.");
        return redirect()->route('post.index', $post);
    }
}
