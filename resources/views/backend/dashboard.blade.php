@extends('layouts.backend')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h1>{{ __('Tableau de Bord') }}</h1>
        <p>{{ __('Bienvenue sur le tableau de bord administrateur !') }}</p>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Clients par Type') }}</div>
                    <div class="card-body">
                        <canvas id="clientsByTypeChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Paiements par Statut') }}</div>
                    <div class="card-body">
                        <canvas id="paymentsByStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Contacts par Mois') }}</div>
                    <div class="card-body">
                        <canvas id="contactsByMonthChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Success alert fade out
            const alert = document.querySelector('.alert-success');
            if (alert) {
                setTimeout(() => {
                    $(alert).alert('close');
                }, 5000); // Close after 5 seconds
            }

            const chartData = @json($chartData);

            // Chart 1: Clients par Type (Pie Chart)
            const clientsByTypeCtx = document.getElementById('clientsByTypeChart').getContext('2d');
            new Chart(clientsByTypeCtx, {
                type: 'pie',
                data: {
                    labels: chartData.clientsByType.labels.map(label => {
                        if (label === 'particulier') return 'Particulier';
                        if (label === 'professionnel') return 'Professionnel';
                        return label;
                    }),
                    datasets: [{
                        label: 'Nombre de Clients',
                        data: chartData.clientsByType.data,
                        backgroundColor: [
                            'rgba(4, 68, 236, 0.6)',
                            'rgba(228, 29, 88, 0.6)'
                        ],
                        borderColor: [
                            'rgba(4, 68, 236, 1)',
                            'rgba(228, 29, 88, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Clients par Type'
                        }
                    }
                }
            });

            // Chart 2: Paiements par Statut (Pie Chart)
            const paymentsByStatusCtx = document.getElementById('paymentsByStatusChart').getContext('2d');
            new Chart(paymentsByStatusCtx, {
                type: 'pie',
                data: {
                    labels: chartData.paymentsByStatus.labels.map(label => {
                        if (label === 'succeeded') return 'Réussi';
                        if (label === 'pending') return 'En Attente';
                        if (label === 'failed') return 'Échoué';
                        return label;
                    }),
                    datasets: [{
                        label: 'Nombre de Paiements',
                        data: chartData.paymentsByStatus.data,
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.6)',
                            'rgba(255, 193, 7, 0.6)',
                            'rgba(220, 53, 69, 0.6)'
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(255, 193, 7, 1)',
                            'rgba(220, 53, 69, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Paiements par Statut'
                        }
                    }
                }
            });

            // Chart 3: Contacts par Mois (Line Chart)
            const contactsByMonthCtx = document.getElementById('contactsByMonthChart').getContext('2d');
            new Chart(contactsByMonthCtx, {
                type: 'line',
                data: {
                    labels: chartData.contactsOverTime.labels.map(monthYear => {
                        const [year, month] = monthYear.split('-');
                        const date = new Date(year, month - 1);
                        return date.toLocaleString('fr-FR', { month: 'short', year: '2-digit' });
                    }),
                    datasets: [{
                        label: 'Nombre de Contacts',
                        data: chartData.contactsOverTime.data,
                        backgroundColor: 'rgba(4, 68, 236, 0.2)',
                        borderColor: 'rgba(4, 68, 236, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Contacts par Mois'
                        }
                    }
                }
            });
        });
    </script>
@endsection
