<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\M200Company;

class ManageCompanyController extends Controller
{
    // Page_ID
    const PG_ID = 'ManageCompanyController';

	/**
	 * Show Manage Company main & Search screen
	 * @param Request $req 
	 * @return type
	 */
    public function index(Request $req)
    {
    	// validate

    	// search
    	$company_list = M200Company::select('*');
    	if (isset($req->kigyo_nm)) {
    		$company_list = $company_list->where('kigyo_nm', 'like', '%' . $req->kigyo_nm . '%');
    	}
    	if (isset($req->address)) {
    		$company_list = $company_list->where('address', 'like', '%' . $req->address . '%');
    	}
    	if (isset($req->keiyaku_date_from)) {
    		$company_list = $company_list->where('keiyaku_date', '>=', $req->keiyaku_date_from);	
    	}
    	if (isset($req->keiyaku_date_to)) {
    		$company_list = $company_list->where('keiyaku_date', '<=', $req->keiyaku_date_to);	
    	}
    	$company_list = $company_list->orderByRaw('kigyo_cd + 0')->paginate();

    	session()->flashInput($req->input());
    	return view(
            'manage.company.index',
            compact('company_list')
        );
    }

    /**
     * Do create, update, delete items
     * @param Request $req 
     * @return type
     */
    public function store(Request $req)
    {
        if (isset($req->create_mode)) {
            return self::do_insert($req);
        }
        if (isset($req->edit_mode)) {
            return self::do_update($req);
        }
    }

    /**
     * Show create screen
     * @param Request $req 
     * @return type
     */
    public function create(Request $req)
    {
        return view('manage.company.create_or_edit', [
            'mode' => 'create',
        ]);
    }

    /**
     * Show edit page
     * {kigyo_cd}/edit
     * @param string $kigyo_cd 
     * @return type
     */
    public function edit(Request $req, $kigyo_cd) 
    {
        $company = M200Company::find($kigyo_cd);
        return view('manage.company.create_or_edit', [
            'mode' => 'edit',
            'company' => $company,
        ]);
    }

    /**
     * Do insert item into the Database
     * @param Request $req 
     * @return type
     */
    public function do_insert(Request $req)
    {
        // validation
        $validator = \Validator::make($req->all(), [
            // 'kigyo_cd' => 'required|unique:m200_company|max:10',
            'kigyo_nm' => 'required|max:255',
            'address' => 'required|max:255',
            'tel' => 'required|max:255',
            'fax' => 'max:255',
            'kigyo_hp' => 'max:255',
            'tantosha' => 'max:255',
            'biko' => 'max:255',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->witherrors($validator);
        }

        // fill data from request
        $company = new M200Company();
        $request_data = array_merge($company->default_values, $req->all());
        $company->fill($request_data);
        $company->after_fill_insert($req, self::PG_ID);
        $company->kigyo_cd = $req->kigyo_cd;

        try {
            $company->save();
            \Cache::flush();
            return redirect("/manage/company/{$company->kigyo_cd}/edit")->withInput()->with('success_message', sprintf(config('message.action_success'), '新規登録'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return back()->withInput()->with([
            'fail_message' => sprintf(config('message.action_fail'), '新規登録'),
            'keep_input' => true,
        ]);
    }

    /**
     * Do update item into the Database
     * @param Request $req 
     * @return type
     */
    public function do_update(Request $req)
    {
        // validation
        $validator = \Validator::make($req->all(), [
            'kigyo_cd' => 'required|max:10',
            'kigyo_nm' => 'required|max:255',
            'address' => 'required|max:255',
            'tel' => 'required|max:255',
            'fax' => 'max:255',
            'kigyo_hp' => 'max:255',
            'tantosha' => 'max:255',
            'biko' => 'max:255',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->witherrors($validator)->with(['keep_input' => true]);
        }

        // update
        $company = M200Company::find($req->kigyo_cd);
        if (isset($company)) {
            $request_data = array_merge($company->default_values, $req->all());
            $company->fill($request_data);
            $company->after_fill_update($req, self::PG_ID);
            
            try {
                $company->save();
                \Cache::flush();
                return back()->withInput()->with('success_message', sprintf(config('message.action_success'), '更新'));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
        return back()->withInput()->with([
            'fail_message' => sprintf(config('message.action_fail'), '更新'),
            'keep_input' => true,
        ]);
    }
}
