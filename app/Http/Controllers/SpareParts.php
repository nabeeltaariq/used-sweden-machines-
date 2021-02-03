<?php

namespace App\Http\Controllers;

use App\Imports\SpareImport;
use Illuminate\Http\Request;
use App\SparePart;
use App\Machine;
use App\PartCatagory;
use App\PartsSubCatagory;
use App\Manufacturer;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;





class SpareParts extends Controller
{

    public function importView()
    {
        return view("admin.importDataPage");
    }

    public function importProcessData(Request $request)
    {

        $this->validate($request, [
            'uploadfile' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('uploadfile');

        Excel::import(new SpareImport, $file);


        // $targetPath = $request->file('uploadfile')->getRealPath();
        // $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        // $spreadSheet = $Reader->load($targetPath);
        // $worksheet = $spreadSheet->getActiveSheet();
        // $highestRow = $worksheet->getHighestRow(); // total number of rows
        // $highestColumn = $worksheet->getHighestColumn(); // total number of columns
        // $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
        // $lines = $highestRow;
        // if ($lines <= 0) {
        //     return "Nothing to import from this file";
        // } else {

        //     for ($row = 2; $row <= $highestRow; ++$row) {
        //         $title = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); //Name
        //         $spare_part_no = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); //Language
        //         $category = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); //Mathematics
        //         $sub_category = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); //Foreign Language
        //         $manufac = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
        //         $price
        //             = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
        //         $ds = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
        //         $machine_id = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
        //         $description = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
        //         $image = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
        //         $sparePart = new SparePart();
        //         $sparePart->title
        //             = $title;
        //         $sparePart->spare_part_no = $spare_part_no;
        //         $sparePart->category = $category;
        //         $sparePart->sub_category = $sub_category;
        //         $sparePart->manufac = $manufac;
        //         $sparePart->ds = $ds;
        //         $sparePart->machine_id = $machine_id;
        //         $sparePart->description = $description;
        //         $sparePart->price = $price;
        //         $sparePart->image = $image;
        //         $present = SparePart::where('spare_part_no', $sparePart->spare_part_no)->get();
        //         $arrays[] = $sparePart->toArray();
        //         SparePart::insertOrIgnore($arrays);
        //         // DB::insert("INSERT IGNORE INTO `sp_spare_parts`( `title`, `spare_part_no`, `category`, `sub_category`, `manufac`, `price`, `ds`, `machine_id`, `description`, `image`) VALUES (' $sparePart->title','$sparePart->spare_part_no','$sparePart->category',' $sparePart->sub_category',' $sparePart->manufac',' $sparePart->price',' $sparePart->description','$sparePart->ds','$sparePart->machine_id','$sparePart->description',' $sparePart->image')");
        //     }
        // }

        return redirect('/admin/spareParts/home');
    }
    public function Index(Request $request)
    {

        return view("admin.machine_home", ["machines" => Machine::all()]);
    }

    public function CatgoryForm(Request $request)
    {
        return view("admin.category_form", ["categories" => PartCatagory::all()]);
    }

    public function MachineForm(Request $request)
    {
        return view("admin.machineForm");
    }

    public function NewCategoryForm(Request $request)
    {
        return view("admin.catForm", ["machines" => Machine::all()]);
    }

    public function home()
    {

        return view("admin.sparePartsHome", ["parts" => SparePart::all()]);
    }


    public function saveMachine(Request $request)
    {
        $machine = new Machine;
        $machine->title = $request->input("machineName");
        $path = $request->file("fileToUpload")->store("products");
        $pathTokens = explode("/", $path);
        $fileName = $pathTokens[1];
        $machine->image = $fileName;
        $machine->save();
        Session::flash("saved", 1);
        return back();
    }

    public function editMachine($id)
    {
        $machine = Machine::where("id", $id)->first();

        return view("admin.editMachine", ["machine" => $machine]);
    }

    public function updateMachine($id, Request $request)
    {
        $machine = Machine::find($id);
        $machine->title = $request->machine_title;

        if ($request->file("machine_pic") != NULL) {
            $path = $request->file("machine_pic")->store("products");
            $pathTokens = explode("/", $path);
            $fileName = $pathTokens[1];
            $machine->image = $fileName;
        }

        $machine->save();

        Session::flash("saved", 1);
        return back();
    }

    public function AddCategory(Request $request)
    {
        $cat = new PartCatagory;
        $cat->title = $request->categoryName;
        $cat->machine_id = $request->machineId;
        $path = $request->file("fileToUpload")->store("products");
        $pathTokens = explode("/", $path);
        $fileName = $pathTokens[1];
        $cat->image = $fileName;
        $cat->save();
        Session::flash("saved", 1);
        return back();
    }


    public function editCategoryForm($id)
    {
        $cat = PartCatagory::find($id);
        return view("admin.editCatForm", ["machines" => Machine::all(), "cat" => $cat]);
    }

    public function updateCategory($id, Request $request)
    {
        $cat = PartCatagory::find($id);
        $cat->title = $request->cat_name;
        $cat->machine_id = $request->machine_id;

        if ($request->file("fileToUpload") != NULL) {
            $path = $request->file("fileToUpload")->store("products");
            $pathTokens = explode("/", $path);
            $fileName = $pathTokens[1];
            $cat->image = $fileName;
        }

        $cat->save();

        Session::flash("saved", 1);
        return back();
    }

    public function SubCatHome($parent_id)
    {
        $subCats = PartsSubCatagory::where("parent_id", $parent_id)->get();
        return view("admin.subCat", ["subCats" => $subCats]);
    }

    public function NewSubCatForm()
    {
        return view("admin.newSubCat", ["machines" => Machine::all(), "categories" => PartCatagory::all()]);
    }

    public function StoreSubCat(Request $request)
    {
        $sub = new PartsSubCatagory;
        $sub->title = $request->subcat_title;
        $sub->machine_id = $request->machine_id;
        $sub->parent_id = $request->parent_cat;
        $sub->best_seller = 0;
        $sub->save();
        Session::flash("saved", 1);
        return back();
    }

    public function editSubCat($id)
    {
        $sub = PartsSubCatagory::find($id);
        return view("admin.editSubCat", ["categories" => PartCatagory::all(), "machines" => Machine::all(), "sub" => $sub]);
    }

    public function updateSubCat($id, Request $request)
    {

        $sub = PartsSubCatagory::find($id);
        $sub->title = $request->subcat_title;
        $sub->machine_id = $request->machine_id;
        $sub->parent_id = $request->parent_cat;
        $sub->save();
        Session::flash("saved", 1);
        return back();
    }

    public function newForm()
    {
        $manufacturer = Manufacturer::all();
        return view("admin.addSparePart", ["manufacture" => $manufacturer, "machines" => Machine::all()]);
    }

    public function storeSparePart(Request $request)
    {

        $part = new SparePart;
        $part->title = $request->title;
        $part->spare_part_no = $request->spare_part_no;
        $part->category = $request->cat_id;
        $part->sub_category = $request->subcat_id;
        $part->manufac = $request->manu_id;
        $part->price = $request->price;
        $part->ds = $request->delivery_scope;
        $part->machine_id = $request->machineId;
        $part->description = $request->spare_part_desc;
        $path = $request->file("fileToUpload")->store("products");
        $pathTokens = explode("/", $path);
        $fileName = $pathTokens[1];
        $part->image = $fileName;
        $part->save();

        Session::flash("saved", 1);
        return back();
    }

    public function editSparePartForm($id)
    {
        $part = SparePart::find($id);
        $category = PartCatagory::where("machine_id", $part->machine_id)->get();
        $sub_category = PartsSubCatagory::where("parent_id", $part->category)->get();
        return view("admin.editSparePartForm", ["part" => $part, "machines" => Machine::all(), "manufacture" => Manufacturer::all(), "categories" => $category, "sub_category" => $sub_category]);
    }

    public function updateSparePart($id, Request $request)
    {

        $part = SparePart::find($id);
        $part->title = $request->title;
        $part->spare_part_no = $request->spare_part_no;
        $part->category = $request->cat_id;
        $part->sub_category = $request->subcat_id;
        $part->manufac = $request->manu_id;
        $part->price = $request->price;
        $part->ds = $request->delivery_scope;
        $part->machine_id = $request->machineId;
        $part->description = $request->spare_part_desc;

        if ($request->file("fileToUpload") != NULL) {
            $path = $request->file("fileToUpload")->store("products");
            $pathTokens = explode("/", $path);
            $fileName = $pathTokens[1];
            $part->image = $fileName;
        }

        $part->save();
        Session::flash("saved", 1);
        return back();
    }

    public function deleteSparePart($id)
    {

        $part = SparePart::find($id);
        $part->delete();
        return back();
    }
}
