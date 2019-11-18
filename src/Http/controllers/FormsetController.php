<?php

namespace khyrie\Formset\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use khyrie\Formset\Models\Fieldset;
use khyrie\Formset\Models\Formset;
use Validator;
use Artisan;

class FormsetController extends Controller
{
    public function index()
    {
        $results = Formset::orderBy('created_at', 'desc')->get();
        $data = ['results' => $results];

        return view('formset::index')->with($data);
    }

    public function create()
    {
        return view('formset::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'desc' => 'required',
        ]);

        /* produce table name */
        $table = 'frm'.trim($request->name);
        $table = strtolower($table);
        $table = preg_replace('/[^0-9a-z]/', '', $table);

        $results = Formset::where('table', 'like', $table.'%')->get();
        if (count($results) > 0) {
            $table = $table.(count($results) + 1);
        }

        $formset = new Formset;
        $formset->name = $request->name;
        $formset->desc = $request->desc;
        $formset->table = $table;
        $formset->save();

        return redirect('/formset')->with(['status' => 'success', 'msg' => 'Successfully inserted.']);
    }

    public function edit($formsetid)
    {
        $formset = Formset::where('id', $formsetid)->get();
        $data = ['formset' => $formset[0]];

        return view('formset::edit')->with($data);
    }

    public function update(Request $request, $formsetid)
    {
        $request->validate([
            'name' => 'required|min:3',
            'desc' => 'required',
        ]);

        /* produce table name */
        // $table = "frm".trim($request->name);
        // $table = strtolower($table);
        // $table = preg_replace("/[^0-9a-z]/", "", $table);

        // $results = Formset::where('table', 'like', $table.'%')->get();
        // if(count($results) > 0) {
        //     $table = $table.(count($results)+1);
        // }

        $formset = Formset::find($formsetid);
        $formset->name = $request->name;
        $formset->desc = $request->desc;
        // $formset->table = $table;
        $formset->save();

        return redirect('/formset')->with(['status' => 'success', 'msg' => 'Successfully updated.']);
    }

    public function show($formsetid)
    {
        $formset = Formset::where('id', $formsetid)->get();
        if (count($formset) > 0) {
            $hastable = Schema::hasTable($formset[0]->table);

            $fieldsets = Fieldset::where('formsetid', $formsetid)->get();
            $data = ['formset' => $formset[0], 'fieldsets' => $fieldsets, 'hastable' => $hastable];

            return view('formset::show')->with($data);
        } else {
            echo 'no record found';
        }
    }

    public function delete($formsetid)
    {
        $result = Formset::where('id', $formsetid)->get();
        Schema::dropIfExists($result[0]->table);

        $path_migration = '../database/migrations';

        $file = $result[0]->file;
        if (! empty($file)) {
            unlink($path_migration.'/'.$file);
        }

        Fieldset::where('formsetid', $formsetid)->delete();
        Formset::where('id', $formsetid)->delete();

        return redirect('/formset')->with(['status' => 'success', 'msg' => 'Successfully deleted.']);
    }

    public function fieldset_create($formsetid)
    {
        $data = ['id' => $formsetid];

        return view('formset::fieldset_create')->with($data);
    }

    public function fieldset_store(Request $request, $formsetid)
    {
        $rules = [
            'name' => 'required|min:2',
            'datatype' => 'required',
        ];
        $validation = Validator::make($request->all(), $rules);

        /* produce field name if empty */
        if (empty($request->field)) {
            $field = trim($request->name);
            $field = strtolower($field);
            $field = preg_replace('/[^0-9a-z]/', '', $field);

            $results = Fieldset::where('formsetid', $formsetid)->where('field', 'like', $field.'%')->get();
            if (count($results) > 0) {
                $field = $field.(count($results) + 1);
            }

            $request->field = $field;
        }

        $validation->after(function ($validation) use ($request) {

            /* reserved values */
            $reservedArr = ['id'];
            if (in_array($request->field, $reservedArr)) {
                $validation->errors()->add('field', 'Value \''.$request->field.'\' is reserved');
            }
        });

        if ($validation->fails()) {
            return redirect('formset/'.$formsetid.'/fieldset/create')->withErrors($validation)->withInput();
        }

        $fieldset = new Fieldset;
        $fieldset->name = $request->name;
        $fieldset->formsetid = $formsetid;
        $fieldset->field = $request->field;
        $fieldset->datatype = $request->datatype;
        $fieldset->save();

        return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully inserted.']);
    }

    public function fieldset_edit($formsetid, $fieldsetid)
    {
        $result = Fieldset::where('id', $fieldsetid)->where('formsetid', $formsetid)->get();
        $data = ['result' => $result[0]];

        return view('formset::fieldset_edit')->with($data);
    }

    public function fieldset_update(Request $request, $formsetid, $fieldsetid)
    {
        $request->validate([
            'name' => 'required|min:2',
            'datatype' => 'required',
        ]);

        /* produce field name if empty */
        // if(empty($request->field)) {
        //     $field = trim($request->name);
        //     $field = strtolower($field);
        //     $field = preg_replace("/[^0-9a-z]/", "", $field);

        //     $results = Fieldset::where('formsetid', $formsetid)->where('field', 'like', $field.'%')->get();
        //     if(count($results) > 0) {
        //         $field = $field.(count($results)+1);
        //     }

        //     $request->field = $field;
        // }

        $fieldset = Fieldset::find($fieldsetid);
        $fieldset->name = $request->name;
        $fieldset->formsetid = $formsetid;
        // $fieldset->field = $request->field;
        $fieldset->datatype = $request->datatype;
        $fieldset->save();

        return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully updated.']);
    }

    public function fieldset_delete($formsetid, $fieldsetid)
    {
        $result = Fieldset::where('id', $fieldsetid)->where('formsetid', $formsetid)->delete();

        return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully deleted.']);
    }

    public function gentable($formsetid)
    {
        $result = Formset::where('id', $formsetid)->get();
        $table = $result[0]->table;

        Schema::dropIfExists($table);

        Schema::create($table, function ($table) use ($formsetid) {
            $fieldsets = Fieldset::where('formsetid', $formsetid)->get();
            if (count($fieldsets) > 0) {
                $table->increments('id');
                foreach ($fieldsets as $key => $fieldset) {
                    $table->{$fieldset->datatype}($fieldset->field);
                }
            }
        });

        return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully create table.']);
    }

    public function genmigration($formsetid)
    {
        $result = Formset::where('id', $formsetid)->get();
        $table = $result[0]->table;

        $fieldsets = Fieldset::where('formsetid', $formsetid)->get();
        if (count($fieldsets) > 0) {
            $path_migration = '../database/migrations';

            $file = $result[0]->file;
            if (! empty($file)) {
                unlink($path_migration.'/'.$file);
                Formset::where('id', $formsetid)->update(['file' => null]);
            }

            $fields[] = 'id:increments';
            foreach ($fieldsets as $key => $fieldset) {
                $fields[] = $fieldset->field.':'.$fieldset->datatype;
            }

            $migrationName = 'create_'.$table.'_table';
            $command = 'make:migration:schema '.$migrationName.' --schema="'.implode(', ', $fields).'"';
            Artisan::call($command);

            if ($handle = opendir($path_migration)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != '.' && $file != '..') {
                        if (strpos($file, $migrationName.'.php') !== false) {
                            Formset::where('id', $formsetid)->update(['file' => $file]);
                        }
                    }
                }
                closedir($handle);
            }

            return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully create migration file.']);
        }
    }
}
