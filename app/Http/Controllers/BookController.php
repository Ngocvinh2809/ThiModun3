<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBookRequest;
use App\Http\Requests\updateBookRequest;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Book::query(true);
        $books = $query->paginate(3);
        $params = [
            'books'    => $books,
        ];
        return view('books.index',  $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeBookRequest $request)
    {
        $books = new Book();
        $books->name = $request->input('name');
        $books->book_id = $request->input('book_id');
        $books->author = $request->input('author');
        $books->category = $request->input('category');
        $books->number_page = $request->input('number_page');
        $books->year = $request->input('year');
        $books->save();
        //dung session de dua ra thong bao
        Session::flash('success', 'Thêm mới thành công');
        //tao moi xong quay ve trang danh sach books
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = Book::findOrFail($id);
        return view('books.edit', compact('books'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(updateBookRequest $request,$id)
    {
        $books = Book::findOrFail($id);
        $books->name = $request->input('name');
        $books->book_id = $request->input('book_id');
        $books->author = $request->input('author');
        $books->category = $request->input('category');
        $books->number_page = $request->input('number_page');
        $books->year = $request->input('year');
        $books->save();
        //dung session de dua ra thong bao
        Session::flash('success', 'Cập nhật thành công');
        //tao moi xong quay ve trang danh sach books
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $books = Book::findOrFail($id)->delete();
            // $this->userRepository->delete($id);
            return response()->json('ok', 200);
        } catch (Exception $e) {
            Log::error(' loi' . $e->getMessage() . ' ở file ' . $e->getFile() . ' dòng ' . $e->getLine());
            return response()->json('errors', 500);
        }
    }
}
