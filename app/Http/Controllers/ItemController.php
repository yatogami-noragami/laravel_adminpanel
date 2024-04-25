<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    // Item List Page
    public function list(Request $request)
    {

        $categories = Category::orderBy('category_id', 'asc')->get(['category_id', 'name']);
        $rollCount = $request->itemRoll;
        if ($rollCount == null) {
            $rollCount = 10;
        }
        $items = Item::orderBy('item_id', 'asc')
            ->paginate($rollCount);

        $items->appends(request()->all());
        $tabName = "item";
        return view('admin.item.list', compact('items', 'categories',  'tabName', 'rollCount'));
    }

    // Item Create Page
    public function createPage()
    {
        $callingCodes = [
            '+93', '+358', '+355', '+213', '+1684', '+376', '+244', '+1264', '+672', '+1268', '+54', '+374', '+297', '+61', '+43', '+994', '+1242', '+973', '+880', '+1246', '+375', '+32', '+501', '+229', '+1441', '+975', '+591', '+599', '+387', '+267', '+55', '+55', '+246', '+673', '+359', '+226', '+257', '+855', '+237', '+1', '+238', '+1345', '+236', '+235', '+56', '+86', '+61', '+672', '+57', '+269', '+242', '+242', '+682', '+506', '+225', '+385', '+53', '+599', '+357', '+420', '+45', '+253', '+1767', '+1809', '+593', '+20', '+503', '+240', '+291', '+372', '+251', '+500', '+298', '+679', '+358', '+33', '+594', '+689', '+262', '+241', '+220', '+995', '+49', '+233', '+350', '+30', '+299', '+1473', '+590', '+1671', '+502', '+44', '+224', '+245', '+592', '+509', '+39', '+504', '+852', '+36', '+354', '+91', '+62', '+98', '+964', '+353', '+44', '+972', '+39', '+1876', '+81', '+44', '+962', '+7', '+254', '+686', '+850', '+82', '+381', '+965', '+996', '+856', '+371', '+961', '+266', '+231', '+218', '+423', '+370', '+352', '+853', '+389', '+261', '+265', '+60', '+960', '+223', '+356', '+692', '+596', '+222', '+230', '+262', '+52', '+691', '+373', '+377', '+976', '+382', '+1664', '+212', '+258', '+95', '+264', '+674', '+977', '+31', '+599', '+687', '+64', '+505', '+227', '+234', '+683', '+672', '+1670', '+47', '+968', '+92', '+680', '+970', '+507', '+675', '+595', '+51', '+63', '+64', '+48', '+351', '+1787', '+974', '+262', '+40', '+7', '+250', '+590', '+290', '+1869', '+1758', '+590', '+508', '+1784', '+684', '+378', '+239', '+966', '+221', '+381', '+381', '+248', '+232', '+65', '+721', '+421', '+386', '+677', '+252', '+27', '+500', '+211', '+34', '+94', '+249', '+597', '+47', '+268', '+46', '+41', '+963', '+886', '+992', '+255', '+66', '+670', '+228', '+690', '+676', '+1868', '+216', '+90', '+7370', '+1649', '+688', '+256', '+380', '+971', '+44', '+1', '+1', '+598', '+998', '+678', '+58', '+84', '+1284', '+1340', '+681', '+212', '+967', '+260', '+263'
        ];
        $categories = Category::orderBy('name')->get();
        $tabName = 'item';
        return view('admin.item.create', compact('categories', 'tabName', 'callingCodes'));
    }

    public function create(Request $request)
    {

        $this->itemValidationCheck($request);
        $data = $this->requestItemCreate($request);

        $fileName = uniqid() . '_' . $request->itemName . '_' . $request->itemPhoto->getClientOriginalName();
        $request->file('itemPhoto')->storeAs('public', $fileName);
        $data['photo'] = $fileName;

        Item::create($data);
        $message = 'Item ' . $data['name'] . ' is added successfully';
        return redirect()->route('item#list')->with(['Message' => $message]);
    }

    // Validation and Return
    private function itemValidationCheck($request)
    {
        Validator::make($request->all(), [
            'itemName' => 'required|unique:items,name',
            'itemCategory' => 'required',
            'itemPrice' => 'required|numeric',
            'itemDescription' => 'required',
            'itemCondition' => 'required',
            'itemType' => 'required',
            'itemPhoto' => 'required|mimes:jpg,jpeg,png|file',
            'itemOwnerName' => 'required',
            'itemOwnerCountryCode' => 'required|numeric',
            'itemOwnerContactNumber' => 'required|numeric',
            'itemOwnerAddress' => 'required',
        ])->validate();
    }

    private function requestItemCreate($request)
    {

        $modifiedItemDescription = strip_tags($request->itemDescription);


        return [
            'category_id' => $request->itemCategory,
            'name' => $request->itemName,
            'price' => $request->itemPrice,
            'description' => $modifiedItemDescription,
            'condition' => $request->itemCondition,
            'type' => $request->itemType,
            'status' => $request->itemStatus,
            'owner_name' => $request->itemOwnerName,
            'country_code' => $request->itemOwnerCountryCode,
            'contact_number' => $request->itemOwnerContactNumber,
            'address' => $request->itemOwnerAddress,
        ];
    }

    // Item Edit Page
    public function editPage($id)
    {
        $callingCodes = [
            '+93', '+358', '+355', '+213', '+1684', '+376', '+244', '+1264', '+672', '+1268', '+54', '+374', '+297', '+61', '+43', '+994', '+1242', '+973', '+880', '+1246', '+375', '+32', '+501', '+229', '+1441', '+975', '+591', '+599', '+387', '+267', '+55', '+55', '+246', '+673', '+359', '+226', '+257', '+855', '+237', '+1', '+238', '+1345', '+236', '+235', '+56', '+86', '+61', '+672', '+57', '+269', '+242', '+242', '+682', '+506', '+225', '+385', '+53', '+599', '+357', '+420', '+45', '+253', '+1767', '+1809', '+593', '+20', '+503', '+240', '+291', '+372', '+251', '+500', '+298', '+679', '+358', '+33', '+594', '+689', '+262', '+241', '+220', '+995', '+49', '+233', '+350', '+30', '+299', '+1473', '+590', '+1671', '+502', '+44', '+224', '+245', '+592', '+509', '+39', '+504', '+852', '+36', '+354', '+91', '+62', '+98', '+964', '+353', '+44', '+972', '+39', '+1876', '+81', '+44', '+962', '+7', '+254', '+686', '+850', '+82', '+381', '+965', '+996', '+856', '+371', '+961', '+266', '+231', '+218', '+423', '+370', '+352', '+853', '+389', '+261', '+265', '+60', '+960', '+223', '+356', '+692', '+596', '+222', '+230', '+262', '+52', '+691', '+373', '+377', '+976', '+382', '+1664', '+212', '+258', '+95', '+264', '+674', '+977', '+31', '+599', '+687', '+64', '+505', '+227', '+234', '+683', '+672', '+1670', '+47', '+968', '+92', '+680', '+970', '+507', '+675', '+595', '+51', '+63', '+64', '+48', '+351', '+1787', '+974', '+262', '+40', '+7', '+250', '+590', '+290', '+1869', '+1758', '+590', '+508', '+1784', '+684', '+378', '+239', '+966', '+221', '+381', '+381', '+248', '+232', '+65', '+721', '+421', '+386', '+677', '+252', '+27', '+500', '+211', '+34', '+94', '+249', '+597', '+47', '+268', '+46', '+41', '+963', '+886', '+992', '+255', '+66', '+670', '+228', '+690', '+676', '+1868', '+216', '+90', '+7370', '+1649', '+688', '+256', '+380', '+971', '+44', '+1', '+1', '+598', '+998', '+678', '+58', '+84', '+1284', '+1340', '+681', '+212', '+967', '+260', '+263'
        ];
        $categories = Category::orderBy('name')->get();
        $tabName = 'item';
        $item = Item::where('item_id', $id)->first();
        return view('admin.item.edit', compact('item', 'categories', 'tabName', 'callingCodes'));
    }

    public function edit(Request $request, $id)
    {
        $this->itemEditCheck($request);
        $data = $this->editReturn($request);

        if ($request->hasFile('itemPhoto')) {
            $oldPhoto = Item::where('item_id', $id)->first();
            $oldPhoto = $oldPhoto->photo;
            $fileName = uniqid() . '_' . $request->itemName . '_' . $request->itemPhoto->getClientOriginalName();
            $request->file('itemPhoto')->storeAs('public', $fileName);
            $data['photo'] = $fileName;
            Storage::delete('public/' . $oldPhoto);
        }


        Item::where('item_id', $id)->update($data);
        $message = 'Item ' . $data['name'] . ' is edited successfully';
        return redirect()->route('item#list')->with(['Message' => $message]);
    }

        // Validation and Return
    private function itemEditCheck($request)
    {
        Validator::make($request->all(), [
            'itemName' => 'required',
            'itemCategory' => 'required',
            'itemPrice' => 'required|numeric',
            'itemDescription' => 'required',
            'itemCondition' => 'required',
            'itemType' => 'required',
            'itemPhoto' => 'mimes:jpg,jpeg,png|file',
            'itemOwnerName' => 'required',
            'itemOwnerCountryCode' => 'required|numeric',
            'itemOwnerContactNumber' => 'required|numeric',
            'itemOwnerAddress' => 'required',
        ])->validate();
    }

    private function editReturn($request)
    {
        $modifiedItemDescription = strip_tags($request->itemDescription);
        return [
            'category_id' => $request->itemCategory,
            'name' => $request->itemName,
            'price' => $request->itemPrice,
            'description' => $modifiedItemDescription,
            'condition' => $request->itemCondition,
            'type' => $request->itemType,
            'status' => $request->itemStatus,
            'owner_name' => $request->itemOwnerName,
            'country_code' => $request->itemOwnerCountryCode,
            'contact_number' => $request->itemOwnerContactNumber,
            'address' => $request->itemOwnerAddress,
        ];
    }

    // Item List Switch
    public function editFast($id, Request $request)
    {
        if ($request->publishSwitch == 'on') {
            $state = 'publish';
        } else {
            $state = 'unpublish';
        }
        $data['status'] = $state;
        Item::where('item_id', $id)->update($data);
        $message = 'Status is changed successfully';
        return redirect()->route('item#list')->with(['Message' => $message]);
    }

    // Item List Delete
    public function delete($id)
    {
        Item::where('item_id', $id)->delete();
        $message = 'Item is deleted successfully';
        return redirect()->route('item#list')->with(['Message' => $message]);
    }
}