<html><head><base href="/" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal de Inventario Digital - Login</title>
<style>
    body { 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: url('http://localhost/C/gif/Blue1.gif') no-repeat center center fixed;
        background-size: cover; 
        color: white; 
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        overflow: hidden;
        position: relative;
    }
    
    /* Overlay to smooth gif transition */
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.3);
        backdrop-filter: blur(1px);
        z-index: -1;
        animation: fadeInOut 4s infinite;
    }

    @keyframes fadeInOut {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.5; }
    }
    
    .login-container { 
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(0,0,0,0.9));
        padding: 30px 50px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 8px 32px rgba(31,38,135,0.37);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255,255,255,0.18);
        transform: perspective(1000px) rotateX(2deg);
        margin-bottom: 20px;
        transition: transform 0.3s ease;
        cursor: move;
    }
    
    .login-container h2 { 
        color: #00ff88;
        margin-bottom: 25px;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 24px;
        text-shadow: 0 0 10px rgba(0,255,136,0.5);
    }
    
    .input-group { 
        margin-bottom: 20px;
    }
    
    .input-group label { 
        display: block;
        margin-bottom: 8px;
        color: #00ff88;
        font-size: 14px;
        text-transform: uppercase;
    }
    
    .input-group input { 
        padding: 12px;
        width: 100%;
        border-radius: 8px;
        border: 2px solid #00ff88;
        background: rgba(0,0,0,0.7);
        color: white;
        transition: all 0.3s ease;
    }
    
    .input-group input:focus {
        outline: none;
        box-shadow: 0 0 15px rgba(0,255,136,0.3);
        transform: scale(1.02);
    }
    
    .submit-btn { 
        background: linear-gradient(45deg, #00ff88, #00ccff);
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        color: black;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .submit-btn:hover { 
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,255,136,0.4);
    }
    
    .branding {
        text-align: center;
        margin-top: 10px;
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .inventario-text {
        font-size: 24px;
        color: #00ff88;
        letter-spacing: 5px;
        text-shadow: 0 0 10px rgba(0,255,136,0.5);
        margin: 5px 0;
        animation: glow 2s ease-in-out infinite;
    }

    .dni-text {
        font-size: 18px;
        color: #00ccff;
        letter-spacing: 10px;
        text-shadow: 0 0 10px rgba(0,204,255,0.5);
        margin: 0;
        animation: glow 2s ease-in-out infinite 0.5s;
    }

    @keyframes glow {
        0%, 100% {
            text-shadow: 0 0 10px rgba(0,255,136,0.5);
        }
        50% {
            text-shadow: 0 0 20px rgba(0,255,136,0.8),
                         0 0 30px rgba(0,255,136,0.6);
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginContainer = document.querySelector('.login-container');
        let isDragging = false;
        let currentX;
        let currentY;
        let initialX;
        let initialY;
        let xOffset = 0;
        let yOffset = 0;

        loginContainer.addEventListener('mousedown', dragStart);
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', dragEnd);

        function dragStart(e) {
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;

            if (e.target === loginContainer) {
                isDragging = true;
            }
        }

        function drag(e) {
            if (isDragging) {
                e.preventDefault();
                currentX = e.clientX - initialX;
                currentY = e.clientY - initialY;

                xOffset = currentX;
                yOffset = currentY;

                setTranslate(currentX, currentY, loginContainer);
            }
        }

        function setTranslate(xPos, yPos, el) {
            el.style.transform = `translate3d(${xPos}px, ${yPos}px, 0) perspective(1000px) rotateX(2deg)`;
        }

        function dragEnd() {
            initialX = currentX;
            initialY = currentY;
            isDragging = false;
        }
    });
</script>
</head>
<body>

<div class="login-container">
    <h2>Inicio de Sesión</h2>
    <form action="validar.php" method="post">
        <div class="input-group">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" required>
        </div>
        <div class="input-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit" class="submit-btn">Iniciar Sesión</button>
        <p id="error-message" style="color:red;"></p>
    </form>
</div>

<div class="branding">
    <div class="inventario-text">INVENTARIO DIGITAL</div>
    <div class="dni-text">DNI</div>
</div>

</body>
</html>