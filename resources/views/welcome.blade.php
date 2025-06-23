<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Ícono clásico del navegador -->
    <link rel="icon" type="image/png" href="{{ asset('/logoweb-1.png') }}" sizes="32x32">

    <!-- Ícono para dispositivos móviles / apps -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/logoweb-1.png') }}">

    <!-- Apple touch icon (opcional si se requiere para iOS) -->
    <link rel="apple-touch-icon" href="{{ asset('/logoweb-1.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Acceso SEMEFO</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .text-center {
            text-align: center;
            width: 90%;
            max-width: 800px;
            margin: 2% auto;
            font-size: 1.6rem;
            color: #909090;
        }

        .pdf-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
            flex-wrap: wrap;
        }

        .pdf-viewer {
            width: 30%;
            height: 700px;
            border: 10px solid rgba(128, 128, 128, 0.3);
            background-color: rgba(128, 128, 128, 0.1);
        }

        @media (max-width: 768px) {
            .pdf-viewer {
                width: 90%;
                height: 300px;
            }
        }

        .btn-custom {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 16px;
            background-color: #334d75;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Curp form */
        #curp-form {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            padding: 20px;
            opacity: 0;
            transform: scale(0.98);
        }

        .curp-card {
            background: #f9f9f9;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 1000px;
            text-align: center;
        }

        .curp-card input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .curp-card button {
            background-color: #334d75;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            cursor: pointer;
        }

        .curp-card button:hover {
            background-color: #0056b3;
        }

        .curp-note {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 10px;
            max-width: 500px;
        }

        .input-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
        }

        .input-row input {
            flex: 1 1 calc(33.33% - 10px);
            min-width: 100px;
        }

        /* Animaciones */
        .fade {
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .fade-out {
            opacity: 0;
            transform: scale(0.98);
            pointer-events: none;
        }

        .fade-in {
            opacity: 1;
            transform: scale(1);
        }

        .enlace-img {
            max-width: 90%;
            height: 100%;
        }
        .enlace-img:hover {
            transform: scale(1.02);
        }

        /* Mensaje de error */
        .curp-error {
            color: #b30000;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
            display: none;
        }

        .result-links {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            min-height: 80vh;
            padding: 20px;
            text-align: center;
        }

        .result-links a {
            width: 60%;
            margin-bottom: 20px;
        }

        .result-links img {
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .result-links img:hover {
            transform: scale(1.02);
        }

        @media (max-width: 768px) {
            .result-links a {
                width: 90%;
            }

            .result-links img {
                height: auto;
                max-height: 60vh;
            }
        }

        .acceso-banner {
            background-color: rgb(33, 39, 80);
            color: white;
            padding: 15px 25px;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: left;
            width: 100%;
            box-sizing: border-box;
            margin-top: 20px;
            height: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .custom-spinner {
            width: 3rem;
            height: 3rem;
            border: 0.4em solid rgba(255, 255, 255, 0.2);
            border-top: 0.4em solid #ffffff;
            border-radius: 50%;
            animation: spin 0.75s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

    </style>
</head>
<body>

    <div id="initial-content" class="fade">
        <div class="text-center">
            <strong>La publicación de las presentes fichas es con el fin de localizar a sus familiares y reintegrar a las personas a casa.</strong>
        </div>

        <div class="pdf-container">
            <iframe src="{{ asset('Aviso-de-confidencialidad-Cedulas-CNI.pdf') }}#toolbar=0" class="pdf-viewer"></iframe>
            <iframe src="{{ asset('Aviso-de-Privacidad-Integral-DGSP.pdf') }}#toolbar=0" class="pdf-viewer"></iframe>
        </div>

        <button class="btn-custom" onclick="mostrarFormulario()">ACEPTAR</button>
    </div>

    <div id="acceso-banner" class="acceso-banner" style="display: none;">
        ACCESO a SEMEFO
    </div>

    <div id="curp-form">
        <div class="curp-card">
            <!-- Primera fila: nombre y apellidos -->
            <div class="input-row">
                <input type="text" id="nombre" placeholder="Nombre(s) *">
                <input type="text" id="pape" placeholder="Primer apellido *">
                <input type="text" id="sape" placeholder="Segundo apellido *">
            </div>

            <!-- Segunda fila: curp, teléfono, email -->
            <div class="input-row">
                <input type="text" id="curp" placeholder="CURP *">
                <input type="tel" id="tel" placeholder="Teléfono">
                <input type="email" id="email" placeholder="Correo electrónico">
            </div>

            <div id="curp-error" class="curp-error"></div>
            <button onclick="validarCURP()">CONTINUAR</button>
        </div>

        <div class="curp-note">
            Este dato es solicitado para verificar la identidad y evitar duplicidad en el registro. La información es confidencial y se utiliza únicamente para este fin.
        </div>
    </div>


    <div id="result-links" class="fade result-links">
        <h2 class="text-center">Selecciona un sistema para redireccionar</h2>

        <a href="#" onclick="registrarAcceso('CNI', 'https://busqueda-cni.fiscaliazacatecas.gob.mx'); return false;">
            <img src="{{ asset('cni.jpg') }}" class="enlace-img" alt="Opción 1">
        </a>

        <a href="#" onclick="registrarAcceso('CINR', 'https://cedid.fiscaliazacatecas.gob.mx'); return false;" style="margin-top: 20px;">
            <img src="{{ asset('ci-nr.jpg') }}" class="enlace-img" alt="Opción 2">
        </a>
    </div>

    <!-- Spinner con overlay -->
    <div id="spinner-overlay" style="
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.4);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    ">
        <div class="custom-spinner"></div>
        <div style="margin-top: 10px; color: white; font-weight: bold;">
            Cargando...
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const TimestampKey = 'Time';  // Clave para guardar el timestamp
            const timer = 30 * 60 * 1000;  // 30 minutos en milisegundos
            // localStorage.setItem('timer', timer);
            // Obtener el tiempo actual
            const currentTime = new Date().getTime();
            
            // Verificar si se ingresaron datos y cuándo
            const storedTime = localStorage.getItem(TimestampKey);

            // si no se han registrado datos o han pasado mas de 30 minutos
            if ((currentTime - storedTime) > timer) {
                localStorage.setItem('accede', false);
            }
            if (localStorage.getItem('accede') === "true") {
                // localStorage.setItem('tiempo', (currentTime - storedTime))
                // Mostrar la ultima seccion
                const initial = document.getElementById('initial-content');
                const banner = document.getElementById('acceso-banner');
                const links = document.getElementById('result-links');

                initial.style.display = 'none';

                banner.style.display = 'block';
                banner.classList.add('fade')

                setTimeout(() => {
                    links.style.display = 'flex';

                    setTimeout(() => {
                        links.classList.add('fade-in');
                        banner.classList.add('fade-in');

                        links.style.opacity = 1;
                    }, 50);
                }, 500);
            }
        })

        function mostrarFormulario() {
            const initial = document.getElementById('initial-content');
            const curp = document.getElementById('curp-form');
            const banner = document.getElementById('acceso-banner');

            // Oculta el contenido inicial con animación
            initial.classList.add('fade-out');

            setTimeout(() => {
                initial.style.display = 'none';

                // Muestra el formulario y prepara para la animación
                curp.style.display = 'flex';
                banner.style.display = 'block';

                // Agrega clase fade (asegura transiciones) y luego trigger de fade-in
                curp.classList.add('fade');
                banner.classList.add('fade')

                setTimeout(() => {
                    curp.style.opacity = 1;
                    curp.classList.add('fade-in');
                    banner.classList.add('fade-in');
                }, 50); // Pequeña pausa para que el navegador lo procese
            }, 500); // Espera a que termine el fade-out
        }

        function validarCURP() {
            const nombre = document.getElementById('nombre').value.trim();
            const pape = document.getElementById('pape').value.trim();
            const sape = document.getElementById('sape').value.trim();
            const curp = document.getElementById('curp').value.trim().toUpperCase();
            const tel = document.getElementById('tel').value.trim();
            const email = document.getElementById('email').value.trim();
            const errorMsg = document.getElementById('curp-error');

            // Expresiones regulares
            const regexCURP = /^[A-Z]{4}\d{6}[HM][A-Z]{5}[0-9A-Z]\d$/;
            const regexTel = /^\d{10}$/;
            const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Validaciones
            if (!nombre || !pape || !sape || !curp) {
                errorMsg.style.display = 'block';
                errorMsg.textContent = 'Ingresa los datos que tienen *.';
                return;
            }

            if (!regexCURP.test(curp)) {
                errorMsg.style.display = 'block';
                errorMsg.textContent = 'CURP inválida. Verifica el formato.';
                return;
            }

            if (!regexTel.test(tel)) {
                errorMsg.style.display = 'block';
                errorMsg.textContent = 'Número de teléfono inválido. Deben ser 10 dígitos.';
                return;
            }

            if (!regexEmail.test(email)) {
                errorMsg.style.display = 'block';
                errorMsg.textContent = 'Correo electrónico inválido.';
                return;
            }

            errorMsg.style.display = 'none';

            // GUARDAR la CURP para uso futuro (localStorage o variable)
            localStorage.setItem('curp', curp);
            localStorage.setItem('nombre', nombre);
            localStorage.setItem('pape', pape);
            localStorage.setItem('sape', sape);
            localStorage.setItem('tel', tel);
            localStorage.setItem('email', email);

            localStorage.setItem('accede', true);
            // Guardar el timestamp actual en el localStorage y marcar que fue mostrado
            localStorage.setItem('Time', new Date().getTime());

            const form = document.getElementById('curp-form');
            const links = document.getElementById('result-links');

            form.classList.remove('fade-in');
            form.classList.add('fade-out');

            setTimeout(() => {
                form.style.display = 'none';
                links.style.display = 'flex';

                setTimeout(() => {
                    links.classList.add('fade-in');
                    links.style.opacity = 1;
                }, 50);
            }, 500);
        }

        function registrarAcceso(tipoAcceso, destino) {
            const curp = localStorage.getItem('curp');
            const nombre = localStorage.getItem('nombre');
            const pape = localStorage.getItem('pape');
            const sape = localStorage.getItem('sape');
            const tel = localStorage.getItem('tel');
            const email = localStorage.getItem('email');
            document.getElementById('spinner-overlay').style.display = 'flex';

            if (!curp) {
                alert('CURP no encontrada. Recarga la página e ingrésala nuevamente.');
                return;
            }

            fetch('/registrar-acceso', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    nombre: nombre,
                    pape: pape,
                    sape: sape,
                    curp: curp,
                    tel: tel,
                    email: email,
                    acceso: tipoAcceso
                })
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error al registrar acceso');
                }
                window.location.href = destino;
            }).catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al registrar el acceso.');
                document.getElementById('spinner-overlay').style.display = 'none';
            });
        }
    </script>

</body>
</html>
