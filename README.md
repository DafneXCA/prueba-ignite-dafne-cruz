# Prueba IGNITE ONLINE 

## Contexto

Actualmente estamos llevando a cabo un proceso de selección para identificar talento con conocimientos en desarrollo de software, particularmente en PHP, Laravel y tecnologías relacionadas.

Como parte de este proceso, queremos invitarte a realizar una prueba técnica que nos permitirá conocer tus conocimientos, habilidades prácticas y capacidad para resolver problemas de desarrollo.

Esta evaluación contiene tres fases aisladas:

1. cuestionario teórico;
2. ejercicio práctico Laravel;
3. presentación en video.

Entrega las tres fases en una rama con tu nombre dentro de tu propio repositorio público de GitHub. Conserva `main` como copia del código base.

## Uso de inteligencia artificial

Esta evaluación debe resolverse de manera individual y **no está permitido utilizar herramientas de inteligencia artificial** en ninguna de sus tres fases.

Esto incluye, entre otras, herramientas como ChatGPT, GitHub Copilot, Gemini, Claude u otros asistentes que generen o modifiquen código, respuestas, consultas SQL, explicaciones, propuestas o guiones para el video.

Puedes consultar la documentación oficial de PHP, Laravel, SQL y Git, pero el análisis y todo el contenido entregado deben ser de tu propia autoría. En la fase 3 puedes proponer una solución que utilice IA para resolver un problema de bibliotecas; la restricción consiste en no usar una herramienta de IA para realizar la evaluación.

El uso de IA durante la prueba invalidara la entrega.

## Preparación y rama de trabajo

1. Clona el repositorio base:

   ```bash
   git clone --branch main --single-branch https://github.com/ignite-latam-online/prueba-ignite.git
   cd prueba-ignite
   ```

2. En tu cuenta personal de GitHub, crea un repositorio **público y vacío**, por ejemplo `prueba-ignite-nombre-apellido`. Elige tu cuenta como propietaria y deja sin agregar README, licencia y `.gitignore`.

3. Cambia el remoto del clon a tu repositorio personal. Sustituye `TU-USUARIO` y `prueba-ignite-nombre-apellido` por los datos de tu repo. Sube `main` una sola vez para publicar el código base.

   ```bash
   git remote set-url origin https://github.com/TU-USUARIO/prueba-ignite-nombre-apellido.git
   git remote -v
   git push -u origin main
   ```

   Comprueba que `origin` apunta a tu cuenta personal antes de hacer push.

4. Antes de resolver la prueba, crea una rama con tu nombre y apellido. Usa minúsculas y guiones, por ejemplo `solucion/ana-garcia`.

   ```bash
   git switch -c solucion/nombre-apellido
   ```

Haz los commits de las tres fases en esa misma rama y súbelos a tu repositorio personal. Mantén `main` con el código base.

## Archivos de la entrega

Debes completar o agregar exclusivamente:

```text
CUESTIONARIO.txt
app/Http/Middleware/RequireSsoForProtectedTitle.php
FASE-3-Nombre-Apellido.mp4
```

Sustituye `Nombre-Apellido` por tu nombre real en el archivo de video.

No modifiques rutas, controladores, modelos, migraciones, pruebas, configuración, dependencias, README o GitHub Actions.

---

# Fase 1 — Cuestionario teórico

La primera fase evalúa conocimientos generales de programación, PHP, Laravel, estructuras de datos, SQL, optimización, CI/CD, APIs HTTP y conocimiento en IA.

Abre:

```text
CUESTIONARIO.txt
```

El archivo contiene siete preguntas abiertas. Debes:

1. responder debajo de cada etiqueta `RESPUESTA`;
2. conservar todos los enunciados;
3. incluir código, SQL o pseudocódigo cuando se solicite;
4. indicar claramente cualquier suposición;
5. guardar las respuestas en el mismo `CUESTIONARIO.txt`.

Cuando termines esta fase, crea un commit en tu rama:

```bash
git add CUESTIONARIO.txt
git commit -m "Cuestionario teórico completo"
git push -u origin solucion/nombre-apellido
```

Usa el nombre real de la rama que creaste en el paso de preparación.

No debes creer otro documento para las respuestas.

---

# Fase 2 — Ejercicio práctico Laravel

## Objetivo

Completar un middleware Laravel que controle el acceso al lector de unos de nuestros productos llamado Winkel. Winkel es una plataforma multiinstitución para comercializar, prestar y leer títulos digitales (libros). Su backend utiliza PHP con Laravel y su lector permite abrir documentos PDF o EPUB.

En el producto real, la mayoría de los títulos requieren que el usuario complete un inicio de sesión mediante Single Sign-On (SSO), por ejemplo con Google, Microsoft Azure o Apple. Algunos títulos pueden habilitarse para lectura pública sin exigir SSO.

Esta prueba no se conecta con proveedores reales. Cuando simula un usuario autenticado, Laravel Sanctum representa el token que Winkel habría generado después de completar correctamente el SSO.

Las reglas son:

| Título | Solicitud | Resultado esperado |
| --- | --- | --- |
| `requires_sso = false` | Invitado | Permitir acceso (`200`) |
| `requires_sso = true` | Invitado | Rechazar (`401`) |
| `requires_sso = true` | Usuario autenticado con Sanctum | Permitir acceso (`200`) |

Los títulos están protegidos por defecto.

## Único archivo de código que debes editar

```text
app/Http/Middleware/RequireSsoForProtectedTitle.php
```

Puedes agregar métodos privados dentro de ese middleware, pero no debes modificar ningún otro archivo de código.

## Lo que se requiere es lo siguiente

El middleware debe:

1. Obtener el título resuelto por Laravel desde el parámetro de ruta `{title}`.
2. Permitir inmediatamente la solicitud cuando `requires_sso` sea `false`.
3. Cuando `requires_sso` sea `true`, comprobar al usuario mediante el guard `sanctum`.
4. Permitir la solicitud cuando exista un usuario autenticado.
5. Rechazar al invitado con estado HTTP `401` y exactamente este JSON:

```json
{
  "code": "SSO_REQUIRED",
  "message": "Authentication is required to access this title."
}
```

6. Mantener el comportamiento `404` de Laravel cuando el título no exista.

## Pistas de Laravel

Laravel aplica route model binding sobre `{title}`. Dentro del middleware puedes consultar el título con:

```php
$request->route('title');
```

El usuario autenticado mediante Sanctum se consulta con:

```php
$request->user('sanctum');
```

El controlador ya devuelve el contenido cuando el middleware permite continuar. No agregues la lógica de autorización al controlador.

## Ejecutar la prueba práctica

Requisitos locales opcionales:

- PHP 8.2 o 8.3;
- Composer 2;
- Git.

Instala dependencias:

```bash
composer install
```

Ejecuta la prueba visible:

```bash
composer test:visible
```

También puedes ejecutar:

```bash
php artisan test --testsuite=Visible
```

No necesitas Docker, PostgreSQL, Node.js, Angular ni credenciales SSO. La prueba utiliza SQLite en memoria.

Cada `push` ejecuta automáticamente las pruebas visibles mediante GitHub Actions. El resultado aparece en la pestaña **Actions** del repositorio.

Las pruebas visibles solo verifican el entorno y el caso público. La evaluación final utiliza pruebas privadas adicionales.

## Entregar la fase práctica

```bash
git add app/Http/Middleware/RequireSsoForProtectedTitle.php
git commit -m "Implementar middleware de acceso SSO para lectores"
git push
```

---

# Fase 3 — Presentación en video

Graba un video de hasta ** 7 minutos** en el que aparezcas explicando tu trabajo durante esta prueba. No es necesario realizar una edición profesional; se evalúan la claridad de la explicación, el razonamiento y la capacidad para comunicar una propuesta técnica.

El video debe incluir dos partes.

## Parte A — Explicación de la fase práctica

Explica brevemente:

- cuál era el problema de acceso al lector;
- cómo funciona tu solución en el middleware;
- cómo distingues un título público de uno protegido;
- cómo utilizaste route model binding y el guard Sanctum;
- qué sucede para un invitado, un usuario autenticado y un título inexistente;
- qué decisión técnica consideras más importante en tu solución;
- cómo comprobarías que la implementación funciona correctamente.

Puedes mostrar el código en pantalla, pero la explicación debe ser tuya y no limitarse a leerlo.

## Parte B — Propuesta para un problema de bibliotecas

Elige un problema real que pueda existir en bibliotecas físicas o digitales o instituciones de educación superior relacionado con el acceso al conocimiento  y explica cómo lo abordarías mediante desarrollo de software.

Algunos temas posibles son:

- uso responsable de inteligencia artificial;
- detección o prevención de plagio;
- aumentar el uso de las colecciones;
- digitalización y preservación de materiales;
- recomendaciones de lectura;
- accesibilidad;
- búsqueda y clasificación de contenidos;
- préstamos, reservas o disponibilidad;
- calidad de metadatos;
- analítica para apoyar decisiones de la biblioteca.

No estás limitado a estos ejemplos.

Tu propuesta debe explicar:

- cuál es el problema y a quién afecta;
- cuál sería la solución;
- cómo interactuarían los usuarios con ella;
- qué componentes técnicos principales necesitaría;
- qué datos utilizaría;
- qué riesgos de privacidad, seguridad, sesgo o uso incorrecto considerarías;
- cuál sería una primera versión pequeña o MVP;
- cómo medirías si la solución produjo una mejora.

## Formato y nombre del video

- Duración: mínimo 3 máximo 7 minutos.
- Formato: MP4.
- Nombre: `FASE-3-Nombre-Apellido.mp4`.
- Utiliza una resolución y compresión razonables para que Git permita subir el archivo (si no se puedo subir a git, subelo a tu nube y comparte el link).
- No incluyas credenciales, datos personales de terceros ni información confidencial.

Agrega el video a la misma rama de las fases anteriores:

```bash
git add FASE-3-Nombre-Apellido.mp4
git commit -m "Añadir vídeo de presentación técnica"
git push
```


---

# Revisión y entrega final


La rama debe contener:

```text
CUESTIONARIO.txt
app/Http/Middleware/RequireSsoForProtectedTitle.php
FASE-3-Nombre-Apellido.mp4
```

Entrega al evaluador:

- La URL de tu **repositorio público personal**, por ejemplo `https://github.com/TU-USUARIO/prueba-ignite-nombre-apellido`.
- El enlace directo a tu rama `solucion/nombre-apellido`.
- El hash del último commit, que puedes obtener con `git rev-parse HEAD`.
- Si entregaste el video en la nube, incluye también el enlace y verifica que el evaluador pueda abrirlo.

Verifica que el repositorio y la rama se puedan abrir sin iniciar sesión en GitHub.

No hagas commit de `vendor`, `.env`, archivos de IDE o credenciales.

## Qué se evalúa

### Fase 1 — Cuestionario

- claridad y precisión de las explicaciones;
- fundamentos de programación y PHP;
- consultas y razonamiento SQL;
- comprensión de índices y optimización;
- comprensión de CI/CD y APIs.
- conocimiento en IA

### Fase 2 — Laravel

- uso correcto de middleware Laravel;
- comprensión de route model binding;
- uso correcto del guard Sanctum;
- preservación del contrato HTTP;
- claridad y alcance reducido del cambio;
- que no se modifiquen archivos fuera del alcance.

### Fase 3 — Video

- claridad y capacidad de síntesis;
- comprensión de la solución implementada;
- identificación de un problema relevante;
- viabilidad y estructura de la propuesta;
- consideración de riesgos, datos y medición de resultados.
