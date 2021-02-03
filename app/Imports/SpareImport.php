<?php

namespace App\Imports;

use App\SparePart;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class SpareImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // $data = SparePart::where('spare_part_no', $row["spare_part_no"]);


        // $sparePart = new SparePart();

        // $sparePart->title = $row["title"];
        // $sparePart->spare_part_no = $row["spare_part_no"];
        // $sparePart->category = $row["category"];
        // $sparePart->sub_category = $row["sub_category"];
        // $sparePart->manufac = $row["manufac"];
        // $sparePart->ds = $row["ds"];
        // $sparePart->machine_id = $row["machine_id"];
        // $sparePart->description = $row["description"];
        // $sparePart->price = $row["price"];
        // $sparePart->image = $row["image"];

        // $arrays[] = $sparePart->toArray();
        // return SparePart::insertOrIgnore($arrays);

        // SparePart::create($row);
        $isExist = SparePart::select("*")
            ->where('spare_part_no', $row["spare_part_no"])
            ->exists();
        if ($isExist) {
            //////
        } else {
            return new SparePart([
                "title" => $row["title"],
                "spare_part_no" => $row["spare_part_no"],
                "category" => $row["category"],
                "sub_category" => $row["sub_category"],
                "manufac" => $row["manufac"],
                "price" => $row["price"],
                "ds" => $row["ds"],
                "machine_id" => $row["machine_id"],
                "description" => $row["description"],
                "image" => $row["image"],


            ]);
        }
    }
}
