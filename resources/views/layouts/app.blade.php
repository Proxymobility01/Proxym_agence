<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $agence->nom_agence ?? 'Mon Application' }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS (utilisé pour la grille et composants de base) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- =============== Layout Principal ================ -->
    <div class="app-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <!-- Logo et Nom -->
            <div class="sidebar-header">
                <div class="logo-container">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                </div>
                <h1 class="agency-name">{{ $agence->nom_agence }}</h1>
                <!-- Toggle Sidebar Button -->
                <button class="toggle-sidebar" id="toggleSidebar">
                    <span class="toggle-icon"></span>
                </button>
            </div>

            <!-- Menu Navigation -->
            <nav class="sidebar-nav">
                <ul>
                    <!-- Dashboard -->
                    <li class="{{ request()->is('') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>

                    <!-- Utilisateurs -->
                    <li class="{{ request()->is('agence_users') ? 'active' : '' }}">
                        <a href="{{ route('agence.users') }}">
                            <span class="icon">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="menu-text">Utilisateurs</span>
                        </a>
                    </li>

                    <!-- Batteries -->
                    <li class="{{ request()->is('messages') ? 'active' : '' }}">
                        <a href="{{ route('batteries.index') }}">
                            <span class="icon">
                                <ion-icon name="battery-charging-outline"></ion-icon>
                            </span>
                            <span class="menu-text">Batteries</span>
                        </a>
                    </li>

                    <!-- Historique -->
                    <li class="{{ request()->is('help') ? 'active' : '' }}">
                        <a href="{{ route('historique.agence') }}">
                            <span class="icon">
                                <ion-icon name="time-outline"></ion-icon>
                            </span>
                            <span class="menu-text">Historique</span>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="{{ request()->is('settings') ? 'active' : '' }}">
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="settings-outline"></ion-icon>
                            </span>
                            <span class="menu-text">Paramètres</span>
                        </a>
                    </li>

                    <!-- Password -->
                    <li class="{{ request()->is('password') ? 'active' : '' }}">
                        <a href="#">
                            <span class="icon">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <span class="menu-text">Mot de passe</span>
                        </a>
                    </li>

                    <!-- Sign Out -->
                    <li class="{{ request()->is('signout') ? 'active' : '' }}">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="menu-text">Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Formulaire de déconnexion (caché) -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Topbar -->
            <header class="topbar">
                <div class="search-container">
                    <ion-icon name="search-outline" class="search-icon"></ion-icon>
                    <input type="text" placeholder="Rechercher...">
                </div>
                
                <div class="user-info">
                    <div class="notifications">
                        <ion-icon name="notifications-outline"></ion-icon>
                        <span class="badge">3</span>
                    </div>
                    <div class="theme-switcher">
                        <span class="theme-icon">☀️</span>
                        <label class="theme-switch">
                            <input type="checkbox" id="themeToggle">
                            <span class="theme-slider"></span>
                        </label>
                        <span class="theme-icon">🌙</span>
                    </div>
                    <div class="user-profile">
                        <img src="{{ asset('images/user.jpg') }}" alt="User">
                        <span>{{ Auth::user()->name ?? 'Utilisateur' }}</span>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>Total Swaps</h3>
                            <p class="stat-value">158</p>
                            <p class="stat-change increase">+12% <span>vs hier</span></p>
                        </div>
                        <div class="stat-icon">
                            <ion-icon name="swap-horizontal-outline"></ion-icon>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>Revenus</h3>
                            <p class="stat-value">12,450 €</p>
                            <p class="stat-change increase">+5% <span>vs hier</span></p>
                        </div>
                        <div class="stat-icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>Batteries Chargées</h3>
                            <p class="stat-value">75%</p>
                            <p class="stat-change decrease">-3% <span>vs hier</span></p>
                        </div>
                        <div class="stat-icon">
                            <ion-icon name="battery-full-outline"></ion-icon>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>Utilisateurs Actifs</h3>
                            <p class="stat-value">42</p>
                            <p class="stat-change increase">+8% <span>vs hier</span></p>
                        </div>
                        <div class="stat-icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-container">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>Analyse des Swaps</h3>
                            <div class="chart-actions">
                                <select class="chart-period">
                                    <option>Cette Semaine</option>
                                    <option>Ce Mois</option>
                                    <option>Cette Année</option>
                                </select>
                            </div>
                        </div>
                        <div class="chart-content">
                            <!-- Canvas pour le graphe -->
                            <canvas id="swapChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3>État des Batteries</h3>
                            <div class="chart-actions">
                                <button class="chart-btn active">Jour</button>
                                <button class="chart-btn">Semaine</button>
                                <button class="chart-btn">Mois</button>
                            </div>
                        </div>
                        <div class="chart-content">
                            <!-- Canvas pour le graphe -->
                            <canvas id="batteryChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Operations -->
                <div class="operations-container">
                    <div class="operations-header">
                        <h2>Opérations Récentes</h2>
                        <a href="#" class="btn-primary">Voir Tout</a>
                    </div>
                    
                    <div class="operations-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Utilisateur</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#SWP-001</td>
                                    <td>
                                        <div class="user-cell">
                                            <img src="{{ asset('images/user1.jpg') }}" alt="User 1">
                                            <span>John Doe</span>
                                        </div>
                                    </td>
                                    <td>Swap</td>
                                    <td>25 Feb, 2025</td>
                                    <td>35 €</td>
                                    <td><span class="status completed">Complété</span></td>
                                </tr>
                                <tr>
                                    <td>#SWP-002</td>
                                    <td>
                                        <div class="user-cell">
                                            <img src="{{ asset('images/user2.jpg') }}" alt="User 2">
                                            <span>Jane Smith</span>
                                        </div>
                                    </td>
                                    <td>Recharge</td>
                                    <td>24 Feb, 2025</td>
                                    <td>20 €</td>
                                    <td><span class="status in-progress">En cours</span></td>
                                </tr>
                                <tr>
                                    <td>#SWP-003</td>
                                    <td>
                                        <div class="user-cell">
                                            <img src="{{ asset('images/user3.jpg') }}" alt="User 3">
                                            <span>Robert Johnson</span>
                                        </div>
                                    </td>
                                    <td>Swap</td>
                                    <td>23 Feb, 2025</td>
                                    <td>35 €</td>
                                    <td><span class="status completed">Complété</span></td>
                                </tr>
                                <tr>
                                    <td>#SWP-004</td>
                                    <td>
                                        <div class="user-cell">
                                            <img src="{{ asset('images/user4.jpg') }}" alt="User 4">
                                            <span>Emily Davis</span>
                                        </div>
                                    </td>
                                    <td>Swap</td>
                                    <td>22 Feb, 2025</td>
                                    <td>35 €</td>
                                    <td><span class="status failed">Échoué</span></td>
                                </tr>
                                <tr>
                                    <td>#SWP-005</td>
                                    <td>
                                        <div class="user-cell">
                                            <img src="{{ asset('images/user5.jpg') }}" alt="User 5">
                                            <span>Michael Brown</span>
                                        </div>
                                    </td>
                                    <td>Recharge</td>
                                    <td>21 Feb, 2025</td>
                                    <td>15 €</td>
                                    <td><span class="status completed">Complété</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Main Content From Page -->
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Custom Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        // Initialiser les graphiques
        document.addEventListener('DOMContentLoaded', function() {
            // Graphique des Swaps
            const swapCtx = document.getElementById('swapChart').getContext('2d');
            const swapChart = new Chart(swapCtx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [{
                        label: 'Swaps',
                        data: [18, 25, 20, 30, 28, 35, 22],
                        borderColor: '#DCDB32',
                        backgroundColor: 'rgba(220, 219, 50, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Revenus (€)',
                        data: [630, 875, 700, 1050, 980, 1225, 770],
                        borderColor: '#101010',
                        backgroundColor: 'rgba(16, 16, 16, 0.05)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Graphique des Batteries
            const batteryCtx = document.getElementById('batteryChart').getContext('2d');
            const batteryChart = new Chart(batteryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Chargées', 'En Charge', 'Déchargées'],
                    datasets: [{
                        data: [65, 25, 10],
                        backgroundColor: [
                            '#DCDB32',
                            '#F3F3F3',
                            '#101010'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    },
                    cutout: '70%'
                }
            });

            // Toggle sidebar
            document.getElementById('toggleSidebar').addEventListener('click', function() {
                document.querySelector('.app-container').classList.toggle('sidebar-collapsed');
            });
        });
    </script>

    <script>
        // JavaScript principal pour l'application
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser le thème en fonction des préférences sauvegardées
    initTheme();
    
    // Toggle Sidebar
    const toggleButton = document.getElementById('toggleSidebar');
    if (toggleButton) {
        toggleButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            document.querySelector('.app-container').classList.toggle('sidebar-collapsed');
        });
    }
    
    // Toggle Theme (Dark/Light mode)
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        themeToggle.addEventListener('change', function() {
            if (this.checked) {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
            // Mise à jour des graphiques si besoin
            updateChartsForTheme();
        });
    }

    // Fermeture automatique du sidebar sur mobile lors des clics en dehors
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');
        
        // Si c'est sur mobile et que le sidebar est ouvert
        if (window.innerWidth <= 768 && document.querySelector('.app-container').classList.contains('sidebar-collapsed')) {
            // Si le clic n'est ni dans le sidebar ni sur le bouton de toggle
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                document.querySelector('.app-container').classList.remove('sidebar-collapsed');
            }
        }
    });

    // Mise en évidence de l'élément actif du menu
    const currentLocation = window.location.pathname;
    const menuItems = document.querySelectorAll('.sidebar-nav li a');
    
    menuItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentLocation.includes(href.replace(/^\//, ''))) {
            item.parentElement.classList.add('active');
        }
    });

    // Animation de l'apparition des cards statistiques
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.stat-card').forEach(card => {
        observer.observe(card);
    });

    // Gestion de l'input file personnalisé
    const fileInputs = document.querySelectorAll('.file-input');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Aucun fichier choisi';
            const fileNameElement = document.querySelector('#file-name');
            if (fileNameElement) {
                fileNameElement.textContent = fileName;
            }
        });
    });

    // Responsive: Ajouter une classe lorsque le menu est collapsé sur mobile
    const checkResponsive = () => {
        if (window.innerWidth <= 768) {
            document.querySelector('.app-container').classList.remove('sidebar-collapsed');
        }
    };

    // Vérifier au chargement et lors du redimensionnement
    checkResponsive();
    window.addEventListener('resize', checkResponsive);

    // Fermer les alertes
    const alertCloseButtons = document.querySelectorAll('.alert .close');
    alertCloseButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.style.opacity = '0';
            setTimeout(() => {
                this.parentElement.style.display = 'none';
            }, 300);
        });
    });

    // Gestion des modals
    const modalTriggers = document.querySelectorAll('[data-toggle="modal"]');
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const modalId = this.getAttribute('data-target');
            const modal = document.querySelector(modalId);
            if (modal) {
                modal.classList.add('show');
            }
        });
    });

    const modalCloseButtons = document.querySelectorAll('.modal-close, .modal-cancel');
    modalCloseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal-backdrop');
            if (modal) {
                modal.classList.remove('show');
            }
        });
    });

    // Fermer les modals lorsqu'on clique en dehors du contenu
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal-backdrop')) {
            event.target.classList.remove('show');
        }
    });

    // Tooltip handling
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(tooltip => {
        const text = tooltip.getAttribute('data-tooltip');
        const span = document.createElement('span');
        span.className = 'tooltip-text';
        span.textContent = text;
        tooltip.classList.add('tooltip');
        tooltip.appendChild(span);
    });

    // Initialisation des filtres de tableau
    initializeTableFilters();
});

// Fonction pour initialiser les filtres de tableau
function initializeTableFilters() {
    const tableFilters = document.querySelectorAll('.table-filter-input');
    
    tableFilters.forEach(filter => {
        filter.addEventListener('keyup', function() {
            const filterValue = this.value.toLowerCase();
            const tableId = this.getAttribute('data-table');
            const table = document.getElementById(tableId);
            
            if (table) {
                const rows = table.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    let matchFound = false;
                    const cells = row.querySelectorAll('td');
                    
                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(filterValue)) {
                            matchFound = true;
                        }
                    });
                    
                    row.style.display = matchFound ? '' : 'none';
                });
            }
        });
    });
}

// Fonctions pour les actions dynamiques
function confirmDelete(element, message = 'Êtes-vous sûr de vouloir supprimer cet élément ?') {
    if (confirm(message)) {
        const form = element.closest('form');
        if (form) {
            form.submit();
        }
    }
}

// Fonction pour afficher/masquer les éléments
function toggleElement(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        if (element.style.display === 'none' || element.style.display === '') {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    }
}

// Fonction pour les requêtes AJAX
function fetchData(url, successCallback, errorCallback) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (typeof successCallback === 'function') {
                successCallback(data);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            if (typeof errorCallback === 'function') {
                errorCallback(error);
            }
        });
}

// Fonction pour mettre à jour les graphiques
function updateChart(chartId, newData) {
    const chartElement = document.getElementById(chartId);
    if (chartElement && window.Chart) {
        const chartInstance = Chart.getChart(chartId);
        if (chartInstance) {
            chartInstance.data = newData;
            chartInstance.update();
        }
    }
}

// Initialiser le thème
function initTheme() {
    // Vérifier le thème sauvegardé ou utiliser les préférences système
    const savedTheme = localStorage.getItem('theme') || 
                      (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    // Appliquer le thème
    document.documentElement.setAttribute('data-theme', savedTheme);
    
    // Mettre à jour le toggle
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        themeToggle.checked = savedTheme === 'dark';
    }
    
    // Mise à jour des graphiques
    updateChartsForTheme();
}

// Mettre à jour les graphiques en fonction du thème
function updateChartsForTheme() {
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    const textColor = isDark ? '#E0E0E0' : '#101010';
    
    // Mettre à jour tous les graphiques si Chart.js est disponible
    if (window.Chart) {
        Chart.helpers.each(Chart.instances, function(chart) {
            // Mettre à jour les options générales
            if (chart.options.scales && chart.options.scales.x) {
                chart.options.scales.x.ticks = chart.options.scales.x.ticks || {};
                chart.options.scales.x.ticks.color = textColor;
                chart.options.scales.x.grid = chart.options.scales.x.grid || {};
                chart.options.scales.x.grid.color = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
            }
            
            if (chart.options.scales && chart.options.scales.y) {
                chart.options.scales.y.ticks = chart.options.scales.y.ticks || {};
                chart.options.scales.y.ticks.color = textColor;
                chart.options.scales.y.grid = chart.options.scales.y.grid || {};
                chart.options.scales.y.grid.color = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
            }
            
            if (chart.options.plugins && chart.options.plugins.legend) {
                chart.options.plugins.legend.labels = chart.options.plugins.legend.labels || {};
                chart.options.plugins.legend.labels.color = textColor;
            }
            
            if (chart.options.plugins && chart.options.plugins.tooltip) {
                chart.options.plugins.tooltip.backgroundColor = isDark ? 'rgba(0, 0, 0, 0.8)' : 'rgba(255, 255, 255, 0.8)';
                chart.options.plugins.tooltip.titleColor = isDark ? '#E0E0E0' : '#101010';
                chart.options.plugins.tooltip.bodyColor = isDark ? '#E0E0E0' : '#101010';
            }
            
            chart.update();
        });
    }
}
    </script>
</body>

</html>