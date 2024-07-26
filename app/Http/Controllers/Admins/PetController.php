<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
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
            $this->pets->createPet($data);
            return redirect()->route('admin.pet.index')->with('success', 'Thêm mới thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
