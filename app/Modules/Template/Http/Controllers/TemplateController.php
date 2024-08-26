<?php

namespace App\Modules\Template\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Template\Models\Template;
use App\Modules\Template\Http\Requests\UpdateTemplateRequest;

class TemplateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        return view('template.edit', [
            'template' => Template::find($id),
        ]);
    }

    /**
     * Update template controller function.
     *
     * @param UpdateTemplateRequest $request
     */
    public function update(UpdateTemplateRequest $request, Template $template)
    {
        $data = $request->validated();  
        $template->update(['template' => $data['template']]);
        return redirect('student');
    }
}
