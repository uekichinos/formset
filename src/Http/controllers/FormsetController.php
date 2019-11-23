<?php

namespace khyrie\Formset\Http\Controllers;

use App\Http\Controllers\Controller;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use khyrie\Formset\Models\Fieldset;
use khyrie\Formset\Models\Formset;
use Validator;

class FormsetController extends Controller
{
    public function index()
    {
        /* get data */
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

        /* check if there any similar table name, if yes append with number */
        $results = Formset::where('table', 'like', $table.'%')->get();
        if (count($results) > 0) {
            $table = $table.(count($results) + 1);
        }

        /* insert record */
        $formset = new Formset;
        $formset->name = $request->name;
        $formset->desc = $request->desc;
        $formset->table = $table;
        $formset->save();
        
        return redirect('/formset')->with(['status' => 'success', 'msg' => 'Successfully created "'.$request->name.'".']);
    }

    public function edit($formsetid)
    {
        /* get data */
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

        /* update record */
        $formset = Formset::find($formsetid);
        $formset->name = $request->name;
        $formset->desc = $request->desc;
        $formset->save();

        return redirect('/formset')->with(['status' => 'success', 'msg' => 'Successfully updated "'.$request->name.'".']);
    }

    public function show($formsetid)
    {
        $formset = Formset::where('id', $formsetid)->get();
        if (count($formset) > 0) {

            /* get data */
            $fields = config('formset.fieldsets');
            $table_migration_btn = config('formset.table_migration_btn');
            $hastable = Schema::hasTable($formset[0]->table);
            $fieldsets = Fieldset::where('formsetid', $formsetid)->get();
            $data = ['formset' => $formset[0], 'fieldsets' => $fieldsets, 'hastable' => $hastable, 'btn_migration' => $table_migration_btn, 'fields' => $fields];

            return view('formset::show')->with($data);
        } 
        else {
            echo 'no record found';
        }
    }

    public function delete($formsetid)
    {
        /* delete table */
        $result = Formset::where('id', $formsetid)->get();
        Schema::dropIfExists($result[0]->table);

        /* delete migration file */
        $path_migration = '../database/migrations';
        $file = $result[0]->file;
        if (! empty($file)) {
            unlink($path_migration.'/'.$file);
        }

        /* delete record in table formset and fieldset */
        Fieldset::where('formsetid', $formsetid)->delete();
        Formset::where('id', $formsetid)->delete();

        return redirect('/formset')->with(['status' => 'success', 'msg' => 'Successfully deleted "'.$result[0]->name.'".']);
    }

    public function fieldset_create($formsetid)
    {
        /* get data */
        $fieldsets = config('formset.fieldsets');
        $data = ['id' => $formsetid, 'fieldsets' => $fieldsets];
        
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

            /* perform clean up */
            $field = strtolower(trim($request->name));
            $field = preg_replace('/[^0-9a-z ]/', '', $field);
            $field = str_replace(' ', '_', $field);

            /* check if there any similar table name, if yes append with number */
            $results = Fieldset::where('formsetid', $formsetid)->where('field', 'like', $field.'%')->get();
            if (count($results) > 0) {
                $field = $field.(count($results) + 1);
            }

            $request->field = $field;
        }

        $validation->after(function ($validation) use ($request) {

            /* check for reserve field */
            $reserve_column = config('formset.column_name_reserve');
            if (array_key_exists($request->field, $reserve_column)) {
                $validation->errors()->add('field', 'Field \''.$request->field.'\' is reserved');
            }
        });

        /* redirect to previous page if error */
        if ($validation->fails()) {
            return redirect('formset/'.$formsetid.'/fieldset/create')->withErrors($validation)->withInput();
        }

        /* create record */
        $fieldset = new Fieldset;
        $fieldset->name = $request->name;
        $fieldset->formsetid = $formsetid;
        $fieldset->field = $request->field;
        $fieldset->datatype = $request->datatype;
        $fieldset->save();

        return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully inserted "'.$request->name.'".']);
    }

    public function fieldset_edit($formsetid, $fieldsetid)
    {
        /* get data */
        $result = Fieldset::where('id', $fieldsetid)->where('formsetid', $formsetid)->get();
        $fieldsets = config('formset.fieldsets');
        $data = ['result' => $result[0], 'fieldsets' => $fieldsets];

        return view('formset::fieldset_edit')->with($data);
    }

    public function fieldset_update(Request $request, $formsetid, $fieldsetid)
    {
        $request->validate([
            'name' => 'required|min:2',
            'datatype' => 'required',
        ]);

        /* update record */
        $fieldset = Fieldset::find($fieldsetid);
        $fieldset->name = $request->name;
        $fieldset->formsetid = $formsetid;
        $fieldset->datatype = $request->datatype;
        $fieldset->save();

        return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully updated "'.$request->name.'".']);
    }

    public function fieldset_delete($formsetid, $fieldsetid)
    {
        /* get data */
        $result = Fieldset::where('id', $fieldsetid)->where('formsetid', $formsetid)->delete();

        return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully deleted.']);
    }

    public function gentable($formsetid)
    {
        /* get data */
        $result = Formset::where('id', $formsetid)->get();
        $table = $result[0]->table;

        /* drop existing table and create new table */
        Schema::dropIfExists($table);
        Schema::create($table, function ($table) use ($formsetid) {
            $fieldsets = Fieldset::where('formsetid', $formsetid)->get();
            if (count($fieldsets) > 0) {

                /* auto generate reserve field */
                $reserve_column = config('formset.column_name_reserve');
                if(count($reserve_column) > 0) {
                    foreach ($reserve_column as $key => $value) {
                        $table->{$value}($key);
                    }
                }

                /* generate field provided by user */
                foreach ($fieldsets as $key => $fieldset) {
                    $table->{$fieldset->datatype}($fieldset->field);
                }
            }
        });

        return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully created table "'.$table.'".']);
    }

    public function genmigration($formsetid)
    {
        /* check setting for table_migration_btn */
        $table_migration_btn = config('formset.table_migration_btn');
        if($table_migration_btn === false) {
            return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Function file migration is disabled.']);
        }

        /* get data */
        $result = Formset::where('id', $formsetid)->get();
        $table = $result[0]->table;

        /* get fields related to this table */
        $fieldsets = Fieldset::where('formsetid', $formsetid)->get();
        if (count($fieldsets) > 0) {

            /* delete migration file if existed */
            $path_migration = '../database/migrations';
            $file = $result[0]->file;
            if (! empty($file)) {
                unlink($path_migration.'/'.$file);
                Formset::where('id', $formsetid)->update(['file' => null]);
            }

            /* gdata fieldset store in array */
            foreach ($fieldsets as $key => $fieldset) {
                $fields[] = $fieldset->field.':'.$fieldset->datatype;
            }

            /* generate new migration file */
            $migrationName = 'create_'.$table.'_table';
            $command = 'make:migration:schema '.$migrationName.' --schema="'.implode(', ', $fields).'"';
            Artisan::call($command);

            /* update new migration file in table */
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

            return redirect('/formset/show/'.$formsetid)->with(['status' => 'success', 'msg' => 'Successfully created migration file.']);
        }
    }
}
