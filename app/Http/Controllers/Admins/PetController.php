<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Models\HinhAnhPet;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public $pets;

    public function __construct()
    {
        $this->pets = new Pet();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách pet';
        $listPets = $this->pets->getPet();
        return view('admins.pets.index', compact('listPets', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(DanhMuc $danhMuc)
    {
        $title = 'Thêm mới pet';
        $danhMucs = $danhMuc->getDanhMuc();
        return view('admins.pets.add', compact('danhMucs', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->except('_token');
            
            $data['is_new'] = $request->has('is_new') ? 1 : 0;
            $data['is_hot'] = $request->has('is_hot') ? 1 : 0;
            $data['is_home'] = $request->has('is_home') ? 1 : 0;

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('uploads/anh_pet', 'public');
            } else {
                $data['image'] = null;
            }
           $pet = Pet::query()->create($data);

            $petID = $pet->id;

            if($request->hasFile('list_hinh_anh')){
                foreach($request->file('list_hinh_anh') as $image){
                    if($image){
                        $path = $image->store('uploads/list_anh_pet/id_' . $petID, 'public');
                        $pet->hinhAnhPet()->create([
                            'pet_id' => $petID,
                            'link_anh' => $path
                        ]);
                    }
                }
            }
           
            return redirect()->route('admin.pet.index')->with('success', 'Thêm mới thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Chi tiết pet';
        $pets = Pet::query()
        ->join('danh_mucs', 'pets.danh_muc_id', '=', 'danh_mucs.id')
        ->find($id);
        $imagePet = HinhAnhPet::query()
        ->join('pets', 'hinh_anh_pets.pet_id', '=', 'pets.id')
        ->select('hinh_anh_pets.id', 'hinh_anh_pets.pet_id', 'hinh_anh_pets.link_anh', 'pets.ten_pet')
        ->where('pet_id', $id)
        ->get();
        return view('admins.pets.detail', compact('title', 'pets', 'imagePet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, DanhMuc $danhMuc)
    {
        $title = 'Sửa pet';
        $danhMucs = $danhMuc->getDanhMuc();
        $pet = $this->pets->find($id);
        if (!$pet) {
            return redirect()->route('admin.pet.index')->with('errors', 'Pet này không tồn tại!');
        }
        return view('admins.pets.update', compact('danhMucs', 'pet', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $data = $request->except('_token', '_method');
            $this->pets->updatePet($data, $id);
            return redirect()->route('admin.pet.index')->with('success', 'Sửa thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pets = $this->pets->find($id);
        if (!$pets) {
            return redirect()->route('admin.pet.index')->with('errors', 'Pet này không tồn tại!');
        }
        $pets->delete();
        return redirect()->route('admin.pet.index')->with('success', 'Xóa thành công!');
    }
}
