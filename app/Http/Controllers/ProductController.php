<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = Product::simplePaginate(2);
            return view('product.index', compact('products', $products));
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B001 index page');
            abort('404');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
          return view('product.create');
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B002 Create page');
            abort('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try{
            $imageName = time() . '.' . $request->file->extension();
            $request->file->storeAs('public/images', $imageName);
            $product = Product::create([
                'name' => $request->name,
                'sku' => $request->sku,
                'image' => $imageName,
                'price' => $request->price,
                'expire_date' => date('Y-m-d H:i:s', strtotime($request->date)),
            ]);

            return redirect()->back()->with('success', 'Product successfully stored.');
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B003 store page');
            abort('404');
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
        try{
            $product = Product::findOrFail($id);

            return view('product.show', compact('product', $product));
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B004 show page');
            abort('404');
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
        try{
            $product = Product::findOrFail($id);

            return view('product.edit', compact('product', $product));
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B005 edit page');
            abort('404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        try{
            $product = Product::findOrFail($id);
            $imageName = '';
            if ($request->hasFile('file')) {
                $imageName = time() . '.' . $request->file->extension();
                $request->file->storeAs('public/images', $imageName);
                if ($product->image) {
                    Storage::delete('public/images/' . $product->image);
                }
            } else {
                $imageName = $product->image;
            }

            $product->update([
                'name' => $request->name,
                'sku' => $request->sku,
                'image' => $imageName,
                'price' => $request->price,
                'expire_date' => $request->date,
            ]);

            return redirect()->back()->with('success', 'Product successfully updated.');
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B005 edit page');
            abort('404');
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
        try{
            $product = Product::findOrFail($id);

            $product->delete();

            return redirect()->back()->with('success', 'Product successfully deleted.');
        } catch (\Exception $exception) {
            Log::critical($exception);
            Log::critical('Code 503 | ErrorCode:B006 delete page');
            abort('404');
        }
    }
}
