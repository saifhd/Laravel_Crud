<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CoverImageRequest;
use App\Http\Requests\LogoImageRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{

    public function index()
    {
        $companies = Company::orderByDesc('id');

        if(auth()->user()->is_admin == 0){
            $companies->where('user_id',auth()->user()->id);
        }
        return view('companies.index',[
            'companies' => $companies->paginate(15)
        ]);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyRequest $request)
    {
        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'website' => $request->website,
            'user_id' => auth()->user()->id
        ]);

        if($request->has('logo')){
            $path = $request->file('logo')->store('logos/'.$company->id,'public');
            $company->update([
                'logo_path' =>$path
            ]);
        }

        if($request->has('cover_images')){
            foreach($request->file('cover_images') as $cover_image){
                $path = $cover_image->store('cover_images/'.$company->id,'public');
                $company->coverImages()->create([
                    'image_path' => $path
                ]);
            }
        }
        return redirect()->route('companies.index')->with('success','Successfully Company Created');
    }

    public function edit(Company $company)
    {
        $this->authorize('view',$company);
        return view('companies.edit',[
            'company' => $company->load('coverImages')
        ]);
    }
    public function update(CompanyRequest $request, Company $company)
    {
        $this->authorize($company);
        $company->update([
            'name' => $request->name,
            'email'=> $request->email,
            'website' => $request->website,
            'telephone' => $request->telephone
        ]);

        return redirect()->back()->with('success','Successfully Company Updated');

    }

    public function destroy(Company $company)
    {
        $this->authorize('forceDelete',$company);
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Successfully Company Deleeted');
    }

    public function logoUpdate(LogoImageRequest $request, $id)
    {
        $company = Company::findOrFail($id);

        if($request->has('logo')){
            if($company->logo_path){
                Storage::disk('public')->delete($company->logo_path);
            }
            $path = $request->file('logo')->store('logos/' . $company->id, 'public');
            $company->update([
                'logo_path' => $path
            ]);
        }
        return redirect()->back()->with('success','Company Logo Updated');
    }

    public function coverImageUpdate($id, CoverImageRequest $request)
    {
        $company = Company::findOrFail($id);

        if($request->has('cover_images')){
            foreach($request->file('cover_images') as $cover_image){
                $path = $cover_image->store('cover_images/' . $company->id, 'public');
                $company->coverImages()->create([
                    'image_path' => $path
                ]);
            }
        }
        return redirect()->back()->with('success', 'Company Cover Images Updated');
    }

}
