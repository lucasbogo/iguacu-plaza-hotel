<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceType;

class ServiceTypeController extends Controller
{
    public function index()
    {
        $serviceTypes = ServiceType::all();
        return view('receptionist.room-service.type.index', compact('serviceTypes'));
    }

    public function create()
    {
        return view('receptionist.room-service.type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'description.string' => 'A descrição deve ser uma string.',
        ]);

        ServiceType::create($request->all());

        return redirect()->route('receptionist.service-types.index')->with('success', 'Tipo de serviço criado com sucesso.');
    }

    public function edit(ServiceType $serviceType)
    {
        return view('receptionist.room-service.type.edit', compact('serviceType'));
    }

    public function update(Request $request, ServiceType $serviceType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'description.string' => 'A descrição deve ser uma string.',
        ]);

        $serviceType->update($request->all());

        return redirect()->route('receptionist.service-types.index')->with('success', 'Tipo de serviço atualizado com sucesso.');
    }

    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();

        return back()->with('success', 'Tipo de serviço excluído com sucesso.');
    }
}
