<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResources;
use App\Http\Resources\BookResourcesDetail;
use App\Models\Book;
use App\Models\BookRead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class BookController extends Controller
{
    public function index(){

       $books = Book::all();
       //return response()->json(['data'=> $books]);
       return BookResources::collection($books);

    }

    public function book_detail(Request $request){

         $email = $request->input('email');
         $bookId = $request->input('book_id');

         $request->validate([
            'email' => 'required|email',
            'book_id' => 'required'
         ]);

        $user = User::where('email',$email)->first();
        $book = Book::where('book_id',$bookId)->first();

        if(!$user || ! $book){
            throw ValidationException::withMessages([
                'data' => ['The provided credentials are incorrect.'],
            ]);
        }

        $currentTime = \Carbon\Carbon::now()->timestamp;
        $token = Hash::make($email.$bookId.$currentTime);

        $data = array(
            "token"=> $token,
            "book_id"=>$bookId,
            "email"=> $email,
        );

        BookRead::create($data);

        //return $user->createToken($request->email)->plainTextToken;
        //$user = User::findByUsername($username);
        return $token;
 
     }

     public function book_access(Request $request){

         $token = $request->input('token');
         $bookRead = BookRead::where('token',$token)->first();

         if(Empty($bookRead)){
            throw ValidationException::withMessages([
               'data' => ['The provided credentials are incorrect.'],
           ]);
         }

         $bookId = $bookRead->book_id;
         $book = Book::where('book_id',$bookId)->first();

         if(! $book){
            throw ValidationException::withMessages([
                'data' => ['The provided credentials are incorrect.'],
            ]);
        }
       

         $path="ebook/".$book->link;
         echo $path;
         $pdf = Storage::get($path);
         return response($pdf, 200)->header('Content-Type', "application/x-pdf");
     }
    
}
