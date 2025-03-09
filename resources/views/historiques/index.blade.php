@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
.transaction-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 8px;
    margin-top: 20px;
}

.transaction-table th {
    background:rgb(25, 18, 102);
    color: white;
    padding: 1rem;
    text-align: left;
}

.transaction-table td {
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
}

.battery-button {
    background: rgb(117, 179, 136);
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.battery-count {
    background: white;
    color:rgb(21, 12, 128);
    padding: 0.2rem 0.5rem;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: bold;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.modal-content {
    position: relative;
    background: white;
    width: 90%;
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #dee2e6;
}

.close-button {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #666;
}

.battery-list {
    max-height: 400px;
    overflow-y: auto;
}

.battery-item {
    padding: 10px;
    margin: 5px 0;
    background: #f8f9fa;
    border-radius: 4px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.type-livraison {
    background: #dbeafe;
    color: #1e40af;
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
}

.type-retour {
    background: #fee2e2;
    color: #991b1b;
    padding: 0.25rem 0.75rem;
    border-radius: 4px;
}
</style>
@section('content')
<div class="detailss" style=" width: 90%">
    <div class="recentOrders">
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Type de Swap</th>
                    <th>Batterie Livrées</th>
                    <th>Batterie Reprises</th>
                    <th>Distributeur</th>
                    <th>Date et Heure</th>
                    <th>Swappeur</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historique as $transaction)
                @php
                // Décoder les batteries si elles sont en format JSON
                $batteriesSortantes = is_string($transaction->bat_sortante) ? json_decode($transaction->bat_sortante,
                true) : $transaction->bat_sortante;
                $batteriesEntrantes = is_string($transaction->bat_entrante) ? json_decode($transaction->bat_entrante,
                true) : $transaction->bat_entrante;

                // S'assurer que les variables sont des tableaux
                $batteriesSortantes = is_array($batteriesSortantes) ? $batteriesSortantes : [];
                $batteriesEntrantes = is_array($batteriesEntrantes) ? $batteriesEntrantes : [];
                @endphp
                <tr>
                    <td>
                        <span class="{{ $transaction->type_swap == 'livraison' ? 'type-livraison' : 'type-retour' }}">
                            {{ ucfirst($transaction->type_swap) }}
                        </span>
                    </td>
                    <td>
                        @if(!empty($batteriesSortantes))
                        <button class="battery-button"
                            onclick="showBatteries('sortante', {{ json_encode($batteriesSortantes) }}, '{{ $transaction->type_swap }}')">
                            Voir les batteries
                            <span class="battery-count">{{ count($batteriesSortantes) }}</span>
                        </button>
                        @else
                        <span class="text-gray-500">Pas de batterie livrées</span>
                        @endif
                    </td>
                    <td>
                        @if(!empty($batteriesEntrantes))
                        <button class="battery-button"
                            onclick="showBatteries('entrante', {{ json_encode($batteriesEntrantes) }}, '{{ $transaction->type_swap }}')">
                            Voir les batteries
                            <span class="battery-count">{{ count($batteriesEntrantes) }}</span>
                        </button>
                        @else
                        <span class="text-gray-500">Pas de batterie Prise</span>
                        @endif
                    </td>
                    <td>
                        @if($transaction->distributeur)
                        {{ $transaction->distributeur->nom }} {{ $transaction->distributeur->prenom }}
                        @else
                        <span class="text-gray-500">Pas de distributeur</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($transaction->date_time)->format('d/m/Y H:i') }}</td>
                    <td>{{ $transaction->user_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

<!-- Modal -->
<div id="batteriesModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Liste des batteries</h3>
            <button class="close-button" onclick="closeModal()">&times;</button>
        </div>
        <div id="batteriesList" class="battery-list">
            <!-- Batteries will be inserted here -->
        </div>
    </div>
</div>

<script>
function showBatteries(type, batteries, swapType) {
    const modal = document.getElementById('batteriesModal');
    const title = document.getElementById('modalTitle');
    const list = document.getElementById('batteriesList');

    // Set title
    title.textContent = `Batteries ${type}s (${batteries.length})`;

    // Clear previous content
    list.innerHTML = '';

    // Add each battery to the list
    batteries.forEach(battery => {
        const item = document.createElement('div');
        item.className = 'battery-item';
        item.innerHTML = ` 
                    <span>Batterie ID: ${battery}</span>
                    <span class="${swapType === 'livraison' ? 'type-livraison' : 'type-retour'}">
                        ${swapType}
                    </span>
                `;
        list.appendChild(item);
    });

    // Show modal
    modal.style.display = 'block';
}

function closeModal() {
    const modal = document.getElementById('batteriesModal');
    modal.style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('batteriesModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>
@endsection