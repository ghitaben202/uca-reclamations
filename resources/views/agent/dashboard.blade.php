@extends('layouts.agent')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Statistiques des Réclamations</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Réclamations -->
                <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-clipboard-list text-blue-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Réclamations</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $total }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- En Cours -->
                <div class="bg-yellow-50 rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 mr-4">
                            <i class="fas fa-clock text-yellow-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">En Cours</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $enCours }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Clôturées -->
                <div class="bg-green-50 rounded-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Clôturées</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $cloturees }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Rejetées -->
                <div class="bg-red-50 rounded-lg p-6 border-l-4 border-red-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 mr-4">
                            <i class="fas fa-times-circle text-red-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Rejetées</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $rejetees }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dernières Réclamations -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Dernières Réclamations</h3>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentReclamations as $reclamation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reclamation->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reclamation->sujet }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $reclamation->statut === 'en cours' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($reclamation->statut === 'clôturée' ? 'bg-green-100 text-green-800' : 
                                               'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($reclamation->statut) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $reclamation->date_creation ? \Carbon\Carbon::parse($reclamation->date_creation)->format('d/m/Y') : 'Non spécifiée' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('agent.reclamations.show', $reclamation) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Aucune réclamation récente</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
