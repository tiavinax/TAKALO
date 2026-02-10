<!DOCTYPE html>
<html lang="fr" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Takalo-takalo - Échange d\'objets'; ?></title>

    <!-- Bootstrap 5 Dark -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.3/dist/css/bootstrap-night.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS personnalisé sombre -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/dark-theme.css">

    <style>
        /* Overrides supplémentaires */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding-top: 70px;
            /* Pour la navbar fixe */
        }

        .navbar-brand {
            font-weight: 900;
            font-size: 1.8rem;
        }

        .logo-glow {
            filter: drop-shadow(0 0 10px rgba(138, 43, 226, 0.5));
        }

        /* Effets spéciaux */
        .card-glow {
            box-shadow: 0 0 30px rgba(138, 43, 226, 0.2);
        }

        .text-gradient-animated {
            background: linear-gradient(90deg, #8a2be2, #00d4aa, #8a2be2);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient 3s linear infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        /* Espacement amélioré */
        main {
            min-height: calc(100vh - 200px);
        }

        /* Ripple effect */
        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.6);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .ripple:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Pattern background -->
    <div class="bg-pattern"></div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo BASE_URL; ?>">
                <i class="bi bi-arrow-left-right me-2 logo-glow"></i>
                <span class="text-gradient-animated">Takalo-takalo</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link ripple <?php echo strpos($_SERVER['REQUEST_URI'], '/mes-objets') !== false ? 'active' : ''; ?>"
                                href="<?php echo BASE_URL; ?>/mes-objets">
                                <i class="bi bi-box me-1"></i> Mes objets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ripple <?php echo strpos($_SERVER['REQUEST_URI'], '/catalogue') !== false ? 'active' : ''; ?>"
                                href="<?php echo BASE_URL; ?>/catalogue">
                                <i class="bi bi-search me-1"></i> Catalogue
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ripple <?php echo strpos($_SERVER['REQUEST_URI'], '/mes-echanges') !== false ? 'active' : ''; ?>"
                                href="<?php echo BASE_URL; ?>/mes-echanges">
                                <i class="bi bi-arrow-left-right me-1"></i> Mes échanges
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center ripple" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-2"></i>
                                <span><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Utilisateur'); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">
                                        <i class="bi bi-person me-2"></i> Mon profil
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="<?php echo BASE_URL; ?>/logout">
                                        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                    </a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary me-2 ripple <?php echo strpos($_SERVER['REQUEST_URI'], '/login') !== false ? 'active' : ''; ?>"
                                href="<?php echo BASE_URL; ?>/login">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary ripple <?php echo strpos($_SERVER['REQUEST_URI'], '/register') !== false ? 'active' : ''; ?>"
                                href="<?php echo BASE_URL; ?>/register">
                                <i class="bi bi-person-plus me-1"></i> Inscription
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container animate-slide-in">
        <?php
        if (isset($content)) {
            echo $content;
        } else {
            echo '<div class="text-center py-5">
                    <div class="loading-dots mx-auto mb-3">
                        <span></span><span></span><span></span>
                    </div>
                    <p class="text-muted">Chargement...</p>
                  </div>';
        }
        ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-2"><i class="bi bi-arrow-left-right text-primary me-2"></i>Takalo-takalo</h5>
                    <p class="text-muted mb-0">Plateforme d'échange d'objets entre particuliers.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex flex-column flex-md-row justify-content-md-end align-items-md-center">
                        <div class="me-md-3 mb-2 mb-md-0">
                            <strong class="d-block text-gradient">Équipe de développement</strong>
                            <small class="text-muted">
                                TIAVINA Anjaranomena - ETU003955<br>
                                RAKOTONDRINA Liantsoa - ETU004318<br>
                            </small>
                        </div>
                        <div>
                            <span class="badge bg-primary animate-float">
                                <i class="bi bi-lightning-charge me-1"></i>
                                FlightPHP & Bootstrap
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript personnalisé -->
    <script src="<?php echo BASE_URL; ?>/public/assets/js/main.js"></script>

    <?php if (isset($scripts)): ?>
        <?php echo $scripts; ?>
    <?php endif; ?>

    <script>
        // Scripts d'amélioration UX
        document.addEventListener('DOMContentLoaded', function() {
            // Effet ripple sur les boutons
            const buttons = document.querySelectorAll('.ripple');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const x = e.clientX - e.target.getBoundingClientRect().left;
                    const y = e.clientY - e.target.getBoundingClientRect().top;

                    const ripple = document.createElement('span');
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple-effect');

                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 1000);
                });
            });

            // Animations au scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-slide-in');
                    }
                });
            }, observerOptions);

            // Observer les cartes et sections
            document.querySelectorAll('.card, section').forEach(el => observer.observe(el));

            // Notification toast
            window.showToast = function(message, type = 'info') {
                const toast = document.createElement('div');
                toast.className = `toast align-items-center text-bg-${type} border-0`;
                toast.setAttribute('role', 'alert');
                toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;

                document.body.appendChild(toast);
                const bsToast = new bootstrap.Toast(toast);
                bsToast.show();

                toast.addEventListener('hidden.bs.toast', () => toast.remove());
            };

            // Auto-hide alerts
            setTimeout(() => {
                document.querySelectorAll('.alert:not(.alert-permanent)').forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    setTimeout(() => bsAlert.close(), 5000);
                });
            }, 3000);
        });
    </script>

    <style>
        /* Ripple effect style */
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>

</html>