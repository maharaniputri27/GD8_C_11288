<?php
namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Movie; /* import model movie */
class MovieController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get movie
        $movie = Movie::latest()->paginate(5);
        //render view with posts
        return view('movie.index', compact('movie'));
    }
    /**
    * create
    *
    * @return void
    */
    public function create()
    {
         return view('movie.create');
    }
    /**
    * store
    *
    * @param Request $request
    * @return void
    */
    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
        'title' => 'required',
        'director' => 'required',
        'duration' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
         $input = $request->all();
   
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $gambarPoster = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $gambarPoster);
            $input['image'] = "$gambarPoster";
        }

    //Fungsi Simpan Data ke dalam Database
    Movie::create([
        'title' => $request->title,
        'director' => $request->director,
        'duration' => $request->duration,
        'image' => $input['image'],
    ]);
    try{
        return redirect()->route('movie.index');
    }catch(Exception $e){
        return redirect()->route('movie.index');
    }
    }
    /**
    * edit
    *
    * @param int $id
    * @return void
    */
    public function edit($id)
    {
        $movie =Movie::find($id);
        return view('movie.edit', compact('movie'));
    }
    /**
    * update
    *
    * @param mixed $request
    * @param int $id
    * @return void
    */
   public function update(Request $request, $id)
{
   $movie = Movie::find($id);

        $this->validate($request, [
            'title' => 'required',
            'director' => 'required',
            'duration' => 'required',
            'image' => 'image|mimes:jpeg,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $gambarPoster = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $gambarPoster);
            $input['image'] = "$gambarPoster";
        } else {
            unset($input['image']);
        }

        $movie->update($input);

        return redirect()->route('movie.index')->with(['success' => 'Data Berhasil Diuah!']);
}

    /**
    * destroy
    *
    * @param int $id
    * @return void
    */
    public function destroy($id)
    {
        $movie =Movie::find($id);
        $movie->delete();
        return redirect()->route('movie.index')->with(['success' => 'Data 
    Berhasil Dihapus!']);
    }
    }

