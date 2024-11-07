<!DOCTYPE html>
<html lang="es">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Préstamos y Devoluciones</title>
    <style>
        /* Estilos generales */
        :root {
            --netflix-red: #E50914;
            --netflix-black: #141414;
            --netflix-dark-gray: #181818;
            --netflix-light-gray: #2F2F2F;
            --netflix-white: #FFFFFF;
            --shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--netflix-black);
            color: var(--netflix-white);
            line-height: 1.6;
        }

        /* Barra de navegación superior */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--netflix-black);
            padding: 1rem 2rem;
            color: var(--netflix-white);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow);
        }

        .navbar-logo {
            font-weight: bold;
            font-size: 1.3rem;
            color: var(--netflix-red);
            cursor: pointer;
            transition: var(--transition);
        }

        .navbar-logo:hover {
            transform: scale(1.05);
        }

        .navbar-menu {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .navbar-item {
            position: relative;
            cursor: pointer;
            color: var(--netflix-white);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: var(--transition);
        }

        .navbar-item:hover {
            background-color: var(--netflix-dark-gray);
            transform: translateY(-2px);
            color: var(--netflix-red);
        }

        /* Submenús mejorados */
        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--netflix-dark-gray);
            min-width: 220px;
            border-radius: 4px;
            box-shadow: var(--shadow);
            padding: 0.5rem 0;
            opacity: 0;
            transition: var(--transition);
        }

        .navbar-item:hover .dropdown-content {
            display: block;
            opacity: 1;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .dropdown-content a {
            display: block;
            padding: 0.8rem 1.5rem;
            color: var(--netflix-white);
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .dropdown-content a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background-color: var(--netflix-red);
            transform: scaleY(0);
            transition: var(--transition);
        }

        .dropdown-content a:hover::before {
            transform: scaleY(1);
        }

        .dropdown-content a:hover {
            background-color: var(--netflix-light-gray);
            padding-left: 2rem;
            color: var(--netflix-red);
        }

        /* Contenido principal */
        .content {
            padding: 120px 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .content h2 {
            color: var(--netflix-white);
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        /* Estilo para el botón de salir */
        .exit-button {
            background-color: var(--netflix-red);
            color: var(--netflix-white);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: var(--transition);
            margin-left: 1.5rem;
        }

        .exit-button:hover {
            background-color: #ff0f1a;
            transform: scale(1.05);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Añadir efecto de ripple a los elementos del menú
            const menuItems = document.querySelectorAll('.navbar-item');
            
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    const ripple = document.createElement('div');
                    ripple.classList.add('ripple');
                    
                    const rect = item.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    
                    item.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Mantener el menú visible al hacer hover
            const dropdowns = document.querySelectorAll('.navbar-item');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('mouseenter', function() {
                    const content = this.querySelector('.dropdown-content');
                    if (content) {
                        content.style.display = 'block';
                        setTimeout(() => {
                            content.style.opacity = '1';
                        }, 50);
                    }
                });

                dropdown.addEventListener('mouseleave', function() {
                    const content = this.querySelector('.dropdown-content');
                    if (content) {
                        content.style.opacity = '0';
                        setTimeout(() => {
                            content.style.display = 'none';
                        }, 300);
                    }
                });
            });

            // Agregar evento para el botón de "Salir"
            const exitButton = document.querySelector('.exit-button');
            
            exitButton.addEventListener('click', function() {
                window.location.href = 'http://10.234.56.80/C/index.php';
            });
        });
    </script>
</head>
<body>

<div class="navbar">
    <div class="navbar-logo">Gestión de Equipos Electrónicos</div>
    <div class="navbar-menu">
        <div class="navbar-item">Inicio</div>
        <div class="navbar-item">Usuarios
            <div class="dropdown-content">
                <a href="http://10.234.56.80/a/index.html">Registrar Usuario</a>
                <a href="http://10.234.56.80/B/Registro_de_Usuario.php">Administrar Usuarios</a>
            </div>
        </div>
        <div class="navbar-item">Gestión de Préstamos
            <div class="dropdown-content">
                <a href="https://example.com/loans">Registro de Préstamos</a>
                <a href="https://example.com/returns">Registro de Devoluciones</a>
                <a href="https://example.com/history">Historial de Préstamos</a>
            </div>
        </div>
        <div class="navbar-item">Gestión de Equipos
            <div class="dropdown-content">
                <a href="https://example.com/equipment">Registrar Equipos</a>
                <a href="https://example.com/maintenance">Equipos en Mantenimiento</a>
                <a href="https://example.com/maintenance-history">Historial de Mantenimiento</a>
            </div>
        </div>
        <div class="navbar-item">Notificaciones
            <div class="dropdown-content">
                <a href="https://example.com/reminders">Recordatorio de Devoluciones</a>
                <a href="https://example.com/alerts">Alertas de Retardo</a>
                <a href="https://example.com/waiting-list">Lista de Espera</a>
            </div>
        </div>
        <div class="navbar-item">Reportes
            <div class="dropdown-content">
                <a href="https://example.com/reports">Reportes de Uso</a>
                <a href="https://example.com/export-excel">Exportar a Excel</a>
                <a href="https://example.com/export-pdf">Generar PDF</a>
            </div>
        </div>
        <div class="navbar-item">Supervisión
            <div class="dropdown-content">
                <a href="https://example.com/active-loans">Préstamos Activos</a>
                <a href="https://example.com/returns-supervision">Devoluciones</a>
                <a href="https://example.com/complete-history">Historial Completo</a>
                <a href="https://example.com/statistics">Estadísticas</a>
            </div>
        </div>
        <div class="navbar-item">Configuración</div>
        <button class="exit-button">Salir</button>
    </div>
</div>

<div class="content">
    <h2>Bienvenido al Sistema de Gestión de Préstamos y Devoluciones</h2>
    <p>Seleccione una opción del menú para comenzar a trabajar.</p>
</div>

</body>
</html>
