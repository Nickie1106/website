<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AdminBooksController extends Controller
{
    /**
     * 書籍一覧表示
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * 書籍追加フォーム表示
     */
    public function create()
    {
        return view('admin.books.add');
    }

    /**
     * 書籍追加処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre_id' => 'required|integer',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->isbn = $request->isbn;
        $book->genre_id = $request->genre_id;

        // 画像アップロード処理
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $book->image = basename($path);
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', '書籍が追加されました。');
    }

    /**
     * 書籍詳細表示
     */
    public function show(Book $book)
    {
        return view('admin.books.details', compact('book'));
    }

    /**
     * 書籍編集フォーム表示
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * 書籍更新処理
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id . '|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'genre_id' => 'required|integer',
        ]);

        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->isbn = $request->isbn;
        $book->genre_id = $request->genre_id;

        // 画像の更新
        if ($request->hasFile('image')) {
            
            if ($book->image) {
                Storage::delete('public/images/' . $book->image);
            }
            $path = $request->file('image')->store('public/images');
            $book->image = basename($path);
        }

        $book->save();

        return redirect()->route('admin.books.index')->with('success', '書籍が更新されました。');
    }

    /**
     * 書籍削除処理
     */
    public function destroy(Book $book)
    {
        // 画像削除
        if ($book->image) {
            Storage::delete('public/images/' . $book->image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', '書籍が削除されました。');
    }

    /**
     * 書籍一括登録フォーム表示
     */
    public function importView()
    {
        return view('admin.books.import');
    }

    /**
     * 書籍一括登録処理
     */

     public function import(Request $request)
     {
         $request->validate([
             'csvFile' => 'required|file|mimes:csv,txt',
         ]);
     
         $file = $request->file('csvFile');
         $csvData = array_map('str_getcsv', file($file->getRealPath()));
         $header = array_shift($csvData); // ヘッダー行を削除
     
         $booksToInsert = [];
         $errors = [];
     
         $validationRules = [
             'title' => 'required|string|max:255',
             'author_name' => 'required|string|max:255',
             'isbn' => 'required|string|unique:books|max:20',
             'genre_id' => 'required|integer',
         ];
     
         DB::beginTransaction();
     
         try {
             foreach ($csvData as $index => $row) {
                 // 必要なカラム数が揃っているかチェック
                 if (count($row) < 4) {
                     $errors[] = "行" . ($index + 2) . "のデータが不足しています。";
                     break; // エラーが1つでもあれば処理を中断
                 }
     
                 $bookData = [
                     'title' => trim($row[0]),
                     'author_name' => trim($row[1]),
                     'isbn' => trim($row[2]),
                     'genre_id' => (int) trim($row[3]),
                 ];
     
                 $validator = Validator::make($bookData, $validationRules);
     
                 if ($validator->fails()) {
                     $errors[] = "行" . ($index + 2) . "のデータが不正です：" . implode(", ", $validator->errors()->all());
                     break; // エラーが1つでもあれば処理を中断
                 }
     
                 $booksToInsert[] = $bookData;
             }
     
             // エラーがあれば処理を中断
             if (!empty($errors)) {
                 DB::rollBack();
                 return redirect()->route('admin.books.import')->withErrors($errors);
             }
     
             // バルクインサート
             if (!empty($booksToInsert)) {
                 Book::insert($booksToInsert);
             }
     
             DB::commit();
     
             // インポート後に追加した本をビューに渡す
             $books = Book::latest()->take(count($booksToInsert))->get();  // 新しく追加された本を取得
             return view('admin.books.import', compact('books'))->with('success', 'CSVデータが正常にインポートされました');
     
         } catch (\Exception $e) {
             DB::rollBack();
             return redirect()->route('admin.books.import')->with('error', 'インポートに失敗しました: ' . $e->getMessage());
         }
     }
     
}


   

    