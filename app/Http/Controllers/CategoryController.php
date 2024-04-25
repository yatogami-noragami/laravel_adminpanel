<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Category List Page
    public function list(Request $request)
    {

        $rollCount = $request->categoryRoll;
        if ($rollCount == null) {
            $rollCount = 10;
        }
        $categories = Category::orderBy('category_id', 'asc')
            ->paginate($rollCount);

        $categories->appends(request()->all());
        $tabName = "category";
        return view('admin.category.list', compact('categories',  'tabName', 'rollCount'));
    }

    // Category Create Page
    public function createPage()
    {
        $tabName = "category";
        return view('admin.category.create', compact('tabName'));
    }


    public function create(Request $request)
    {

        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryCreate($request);

        $fileName = uniqid() . '_' . $request->categoryName . '_' . $request->categoryPhoto->getClientOriginalName();
        $request->file('categoryPhoto')->storeAs('public', $fileName);

        $data['photo'] = $fileName;

        Category::create($data);
        $message = 'Category ' . $data['name'] . ' is added successfully';
        return redirect()->route('category#list')->with(['Message' => $message]);
    }

    // Validation and Return
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name',
            'categoryPhoto' => 'required|mimes:jpg,jpeg,png|file'
        ])->validate();
    }

    private function requestCategoryCreate($request)
    {
        return [
            'name' => $request->categoryName,
            'status' => $request->categoryStatus,
        ];
    }

    // Category Edit Page
    public function editPage($id)
    {
        $tabName = "category";
        $category = Category::where('category_id', $id)->first();
        return view('admin.category.edit', compact('category', 'tabName'));
    }

    public function edit(Request $request, $id)
    {
        $this->categoryEditCheck($request);
        $data = $this->editReturn($request);
        if ($request->hasFile('categoryPhoto')) {
            $oldPhoto = Category::where('category_id', $id)->first();
            $oldPhoto = $oldPhoto->photo;
            $fileName = uniqid() . '_' . $request->categoryName . '_' . $request->categoryPhoto->getClientOriginalName();
            $request->file('categoryPhoto')->storeAs('public', $fileName);
            $data['photo'] = $fileName;
            Storage::delete('public/' . $oldPhoto);
        }

        Category::where('category_id', $id)->update($data);
        $message = 'Category ' . $data['name'] . ' is edited successfully';

        return redirect()->route('category#list')->with(['Message' => $message]);
    }

    // Validation and Return
    private function categoryEditCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required',
            'categoryPhoto' => 'mimes:jpg,jpeg,png|file'
        ])->validate();
    }


    private function editReturn($request)
    {
        return [
            'name' => $request->categoryName,
            'status' => $request->categoryStatus
        ];
    }

    // Category List Switch
    public function editFast($id, Request $request)
    {
        if ($request->publishSwitch == 'on') {
            $state = 'publish';
        } else {
            $state = 'unpublish';
        }
        $data['status'] = $state;
        Category::where('category_id', $id)->update($data);
        $message = 'Status is changed successfully';
        return redirect()->route('category#list')->with(['Message' => $message]);
    }

    // Category List Delete
    public function delete($id)
    {
        Category::where('category_id', $id)->delete();
        $message = 'Category is deleted successfully';
        return redirect()->route('category#list')->with(['Message' => $message]);
    }
}
