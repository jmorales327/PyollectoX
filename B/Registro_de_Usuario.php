<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro de Usuarios</title>
    <style>
        /* Estilos generales y de la interfaz */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Netflix Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        body {
            background: #141414;
            min-height: 100vh;
            padding: 2rem;
            color: #ffffff;
        }
        .container {
            background: rgba(0, 0, 0, 0.85);
            padding: 2rem;
            border-radius: 4px;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }
        .nav-buttons {
            position: fixed;
            top: 2rem;
            right: 2rem;
            display: flex;
            gap: 1rem;
            z-index: 1000;
        }
        .nav-btn {
            background: rgba(229, 9, 20, 0.9);
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .nav-btn:hover {
            background: #E50914;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        }
        .nav-btn.close {
            background: rgba(51, 51, 51, 0.9);
        }
        .nav-btn.close:hover {
            background: #333333;
        }
        h1 {
            color: #E50914;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            font-weight: bold;
        }
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 3fr;
            gap: 2rem;
        }
        .form-section {
            padding: 2rem;
            background: rgba(51, 51, 51, 0.7);
            border-radius: 4px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #ffffff;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 4px;
            background: #333333;
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        input:focus {
            background: #454545;
            outline: none;
        }
        .btn {
            background: #E50914;
            color: white;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn:hover {
            background: #f40612;
            transform: translateY(-2px);
        }
        .btn-delete, .btn-cancel {
            background: #333333;
        }
        .btn-delete:hover, .btn-cancel:hover {
            background: #545454;
        }
        .table-container {
            overflow-x: visible;
            margin-top: 1rem;
            border-radius: 4px;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(51, 51, 51, 0.7);
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #242424;
        }
        th {
            background: #E50914;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        tr:hover {
            background: rgba(229, 9, 20, 0.1);
        }
        .actions {
            display: flex;
            gap: 0.5rem;
        }
        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
            background: #333333;
        }
        .btn-action:hover {
            background: #E50914;
        }
        .success-message, .error-message {
            color: white;
            padding: 1rem;
            border-radius: 4px;
            text-align: center;
            margin-top: 1rem;
        }
        .success-message {
            background: rgba(39, 174, 96, 0.9);
        }
        .error-message {
            background: rgba(229, 9, 20, 0.9);
        }
    </style>
</head>
<body>

<div class="nav-buttons">
    <button class="nav-btn" onclick="window.location.href='http://10.234.56.80/B/inicio.php'">Inicio</button>
    <button class="nav-btn close" onclick="window.location.href='http://10.234.56.80/C/index.php'">Cerrar</button>
</div>

<div class="container">
    <h1>Sistema de Registro de Usuarios</h1>
    <div class="grid-container">
        <div class="form-section">
            <form id="userForm">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn" id="submitBtn">Guardar Usuario</button>
                <button type="button" class="btn btn-delete" id="deleteBtn" style="display: none;">Eliminar Usuario</button>
                <button type="button" class="btn btn-cancel" id="cancelBtn" style="display: none;">Cancelar Edición</button>
            </form>
            <div id="message"></div>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="userList">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
class UserManager {
    constructor() {
        this.currentId = null;
        this.init();
    }

    init() {
        document.getElementById('userForm').addEventListener('submit', (e) => this.handleSubmit(e));
        document.getElementById('deleteBtn').addEventListener('click', () => this.deleteUser());
        document.getElementById('cancelBtn').addEventListener('click', () => this.cancelEdit());
        this.loadUsers();
    }

    async loadUsers() {
        const response = await fetch('user_manager.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ action: 'read' })
        });
        
        const result = await response.json();
        if (result.success) {
            this.displayUsers(result.data);
        } else {
            console.error(result.message);
        }
    }

    async handleSubmit(e) {
        e.preventDefault();
        const formData = new FormData(document.getElementById('userForm'));
        formData.append('action', this.currentId ? 'update' : 'create');
        if (this.currentId) formData.append('id', this.currentId);

        const response = await fetch('user_manager.php', {
            method: 'POST',
            body: new URLSearchParams(formData)
        });

        const result = await response.json();
        this.showMessage(result.message, result.success);

        if (result.success) {
            this.resetForm();
            this.loadUsers();  // Llamar aquí para actualizar la lista de usuarios sin recargar la página
        }
    }

    async deleteUser() {
        if (this.currentId) {
            const response = await fetch('user_manager.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ action: 'delete', id: this.currentId })
            });

            const result = await response.json();
            this.showMessage(result.message, result.success);
            if (result.success) {
                this.resetForm();
                this.loadUsers();
            }
        }
    }

    editUser(id, nombre, apellido, usuario, password) {
        document.getElementById('nombre').value = nombre;
        document.getElementById('apellido').value = apellido;
        document.getElementById('usuario').value = usuario;
        document.getElementById('password').value = password;
        this.currentId = id;
        document.getElementById('submitBtn').textContent = 'Actualizar Usuario';
        document.getElementById('deleteBtn').style.display = 'block';
        document.getElementById('cancelBtn').style.display = 'block';
    }

    cancelEdit() {
        this.resetForm();
    }

    resetForm() {
        document.getElementById('userForm').reset();
        this.currentId = null;
        document.getElementById('submitBtn').textContent = 'Guardar Usuario';
        document.getElementById('deleteBtn').style.display = 'none';
        document.getElementById('cancelBtn').style.display = 'none';
    }

    displayUsers(users) {
        const userList = document.getElementById('userList');
        userList.innerHTML = users.map(user => `
            <tr>
                <td>${user.id}</td>
                <td>${user.nombre}</td>
                <td>${user.apellido}</td>
                <td>${user.usuario}</td>
                <td>${'*'.repeat(user.contrasena.length)}</td>
                <td class="actions">
                    <button onclick="userManager.editUser(${user.id}, '${user.nombre}', '${user.apellido}', '${user.usuario}', '${user.contrasena}')" class="btn btn-action">Editar</button>
                    <button onclick="userManager.reassign(${user.id})" class="btn btn-action">Reasignar</button>
                </td>
            </tr>
        `).join('');
    }

    async reassign(id) {
        await fetch('user_manager.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ action: 'update', id, nombre: 'reasignar', apellido: 'reasignar', usuario: 'reasignar', contrasena: '' })
        });
        this.loadUsers();
    }

    showMessage(message, isSuccess) {
        const messageDiv = document.getElementById('message');
        messageDiv.textContent = message;
        messageDiv.className = isSuccess ? 'success-message' : 'error-message';
        setTimeout(() => {
            messageDiv.textContent = '';
            messageDiv.className = '';
        }, 3000);
    }
}

const userManager = new UserManager();
</script>

</body>
</html>