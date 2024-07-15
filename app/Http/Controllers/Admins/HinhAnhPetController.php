<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\HinhAnhPet;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HinhAnhPetController extends Controller
{
    public $anhPet;

    public function __construct()
    {
        $this->anhPet = new HinhAnhPet();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Ảnh pet';
        $hinhAnhPet = $this->anhPet->getAnhPet();
<<<<<<< HEAD
        return view('admins.hinh_anh_pets.index', compact('hinhAnhPet'));
=======
        return view('admins.hinh_anh_pets.index', compact('hinhAnhPet', 'title'));
>>>>>>> 5cc87333fcc71ca29c23714c1e148a9626f6730b
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pet $pets)
    {
        $title = 'Thêm mới ảnh pet';
        $petName = $pets->getPet();
<<<<<<< HEAD
        return view('admins.hinh_anh_pets.add', compact('petName'));
=======
        return view('admins.hinh_anh_pets.add', compact('petName', 'title'));
>>>>>>> 5cc87333fcc71ca29c23714c1e148a9626f6730b
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('link_anh')) {
            $fileName = $request->file('link_anh')->store('uploads/anh_pet', 'public');
        } else {
            $fileName = null;
        }
        $data = [
            'link_anh' => $fileName,
            'pet_id' => $request->pet_id
        ];
        $this->anhPet->createAnhPet($data);
        return redirect()->route('anh-pet.index');
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
    public function edit(string $id, Pet $pets)
    {
        $title = 'Sửa ảnh pet';
        $anhPet = $this->anhPet->find($id);
        $petName = $pets->getPet();
        if (!$anhPet) {
            return redirect()->route('anh-pet.index');
        }
        return view('admins.hinh_anh_pets.update', compact('anhPet', 'petName', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anhPet = $this->anhPet->find($id);
        if ($request->hasFile('link_anh')) {
            if ($anhPet->link_anh) {
                Storage::disk('public')->delete($anhPet->link_anh);
            }
            $fileName = $request->file('link_anh')->store('uploads/anh_pet', 'public');
        } else {
            $fileName = $anhPet->link_anh;
        }
        $data = [
            'link_anh' => $fileName,
            'pet_id' => $request->pet_id
        ];
        $this->anhPet->updateAnhPet($data, $id);
        return redirect()->route('anh-pet.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anhPet = $this->anhPet->find($id);
        if (!$anhPet) {
            return redirect()->route('anh-pet.index');
        }
        $anhPet->delete();
        return redirect()->route('anh-pet.index');
    }
}
