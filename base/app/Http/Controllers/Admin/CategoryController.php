<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $pageTitle  = 'Categories';
        $categories = Category::orderBy('name')->paginate(getPaginate());
        return view('admin.category.index', compact('pageTitle', 'categories'));
    }
    public function store(Request $request)
    {
        $imageValidation = $request->id ? 'nullable' : 'required';
        
        $request->validate([
            'name'        => 'required|unique:categories,name,'.$request->id,
            'image'       => ["$imageValidation", new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($request->id) {
            $category           = Category::findOrFail($request->id);
            $notification       = 'Category updated successfully';
        } else {
            $category           = new Category();
            $notification       = 'Category added successfully';
        }

        if ($request->hasFile('image')) {
            try {
                $old = @$category->image;
                $category->image = fileUploader($request->image, getFilePath('category'), getFileSize('category'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload category image'];
                return back()->withNotify($notify);
            }
        }

        $category->name = $request->name;
        $category->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }
    public function status($id)
    {
        return Category::changeStatus($id);
    }
}