#!/usr/bin/env bash
# ---------------------------------------------------------------------------
# check-stack.sh — Diagnóstico de convivencia Laravel + Inertia/Vue + Filament
# Uso: bash check-stack.sh   (desde la raíz del proyecto)
# No modifica nada. Solo lee e informa.
# ---------------------------------------------------------------------------

OK="\033[0;32m  OK \033[0m"
WARN="\033[0;33m AVISO\033[0m"
ERR="\033[0;31m FALLA\033[0m"
DIM="\033[2m"
OFF="\033[0m"
BOLD="\033[1m"

problemas=0
avisos=0

titulo() { echo -e "\n${BOLD}$1${OFF}"; echo "------------------------------------------------------------"; }
ok()     { echo -e "[$OK] $1"; }
aviso()  { echo -e "[$WARN] $1"; avisos=$((avisos+1)); }
falla()  { echo -e "[$ERR] $1"; problemas=$((problemas+1)); }
nota()   { echo -e "        ${DIM}$1${OFF}"; }

if [ ! -f artisan ]; then
    echo "No encuentro ./artisan. Ejecuta este script desde la raíz del proyecto Laravel."
    exit 1
fi

# ===========================================================================
titulo "1. Versiones instaladas"
# ===========================================================================
php artisan --version 2>/dev/null | sed 's/^/        /'

for pkg in inertiajs/inertia-laravel filament/filament livewire/livewire; do
    v=$(composer show "$pkg" 2>/dev/null | awk '/^versions/ {print $NF}')
    [ -n "$v" ] && nota "$pkg  $v" || nota "$pkg  (no instalado)"
done

for pkg in vue @inertiajs/vue3 alpinejs vee-validate zod; do
    v=$(node -p "try{require('./node_modules/$pkg/package.json').version}catch(e){'-'}" 2>/dev/null)
    [ "$v" != "-" ] && nota "$pkg  $v" || nota "$pkg  (no instalado)"
done

# ===========================================================================
titulo "2. Alpine duplicado (la causa nº1 de conflictos)"
# ===========================================================================
# Filament trae su propio Alpine empaquetado. Si tu front también lo carga
# globalmente, en /admin se cargan dos instancias y Alpine lanza
# "Detected multiple instances of Alpine running".
alpine_pkg=$(node -p "try{require('./package.json').dependencies?.alpinejs||require('./package.json').devDependencies?.alpinejs||''}catch(e){''}" 2>/dev/null)
alpine_blade=$(grep -rl "Alpine\|alpinejs" resources/views/*.blade.php 2>/dev/null | head -5)

if [ -z "$alpine_pkg" ]; then
    ok "No tienes alpinejs como dependencia propia. Sin riesgo de duplicado."
else
    aviso "Tienes alpinejs $alpine_pkg instalado además del de Filament."
    nota "Verifica que NO se cargue en el layout que usa /admin."
    [ -n "$alpine_blade" ] && nota "Referencias en: $(echo $alpine_blade | tr '\n' ' ')"
fi

# ===========================================================================
titulo "3. Livewire cargándose en rutas Inertia"
# ===========================================================================
# @livewireScripts o @livewireStyles en el layout raíz de Inertia carga
# Livewire en TODO el sitio público sin necesidad.
raiz=$(ls resources/views/app.blade.php resources/views/layouts/app.blade.php 2>/dev/null | head -1)
if [ -n "$raiz" ]; then
    nota "Layout raíz de Inertia: $raiz"
    if grep -qE "@livewire(Scripts|Styles)|@filament" "$raiz" 2>/dev/null; then
        falla "El layout de Inertia carga directivas de Livewire/Filament."
        nota "Quítalas: Filament inyecta las suyas en su propio layout."
    else
        ok "El layout de Inertia no carga Livewire ni Filament."
    fi
else
    aviso "No encontré resources/views/app.blade.php. Revisa tu layout raíz a mano."
fi

# ===========================================================================
titulo "4. Entradas de Vite separadas"
# ===========================================================================
vite=$(ls vite.config.js vite.config.ts vite.config.mjs 2>/dev/null | head -1)
if [ -n "$vite" ]; then
    nota "Archivo: $vite"
    if grep -q "filament" "$vite" 2>/dev/null; then
        entradas=$(grep -c "resources/css/filament" "$vite" 2>/dev/null)
        ok "Hay un entry dedicado para el theme de Filament."
        nota "Confirma que NO comparta archivo con el CSS del front."
    else
        ok "Sin theme custom de Filament (usa el CSS por defecto del panel)."
    fi
    if grep -qE "input:\s*\[" "$vite"; then
        nota "Entradas declaradas:"
        grep -A6 "input:" "$vite" | grep -oE "'[^']*\.(js|css|ts)'" | sed 's/^/          /'
    fi
else
    falla "No encontré vite.config. ¿Proyecto con Mix?"
fi

# ===========================================================================
titulo "5. Tailwind: content paths cruzados"
# ===========================================================================
# Si el tailwind del front escanea vendor/filament, tu bundle CSS crece con
# clases que nunca usas. Y si el theme de Filament escanea resources/js,
# pasa lo inverso.
tw=$(ls tailwind.config.js tailwind.config.ts 2>/dev/null | head -1)
if [ -n "$tw" ]; then
    if grep -q "vendor/filament" "$tw" 2>/dev/null; then
        aviso "Tu tailwind.config del front escanea vendor/filament."
        nota "Eso infla el CSS público. Muévelo al config del theme del panel."
    else
        ok "El tailwind del front no escanea vendor/filament."
    fi
else
    nota "Sin tailwind.config (Tailwind v4 con @source, o no usas Tailwind)."
fi

# ===========================================================================
titulo "6. HandleInertiaRequests: share eager"
# ===========================================================================
# El middleware de Inertia corre en TODO el grupo web, incluido /admin.
# Un share con queries eager se ejecuta en cada carga del panel.
hir="app/Http/Middleware/HandleInertiaRequests.php"
if [ -f "$hir" ]; then
    # Busca llamadas a modelos o auth dentro de share() sin closure
    sospechoso=$(grep -nE "^\s*'[a-zA-Z_]+'\s*=>\s*(auth\(\)|[A-Z][a-zA-Z]*::)" "$hir")
    if [ -n "$sospechoso" ]; then
        aviso "Hay props compartidas evaluadas de forma eager:"
        echo "$sospechoso" | sed 's/^/          /'
        nota "Envuélvelas en closures: 'user' => fn () => auth()->user()"
        nota "Así no se ejecutan en los requests de Filament."
    else
        ok "Las props compartidas usan closures o son estáticas."
    fi
    if grep -q "'flash'" "$hir"; then
        ok "El flash de sesión está compartido (lo necesita tu formulario)."
    else
        aviso "No compartes 'flash'. El mensaje de éxito del formulario no llegará."
    fi
else
    aviso "No encontré $hir"
fi

# ===========================================================================
titulo "7. Colisión de rutas entre el panel y el front"
# ===========================================================================
panel=$(grep -rhoE -e "\->path\(['\"][^'\"]*['\"]\)" app/Providers/Filament/*.php 2>/dev/null | head -1 | grep -oE "['\"][^'\"]*['\"]" | tr -d "\"'")
panel=${panel:-admin}
nota "Path del panel Filament: /$panel"

colisiones=$(php artisan route:list --json 2>/dev/null \
    | node -e "
let d='';process.stdin.on('data',c=>d+=c).on('end',()=>{
  try{
    const r=JSON.parse(d), p='$panel';
    const inertia=r.filter(x=>x.uri===p||x.uri.startsWith(p+'/'))
      .filter(x=>!(x.action||'').includes('Filament'));
    if(inertia.length) inertia.slice(0,10).forEach(x=>console.log('          '+x.method.padEnd(12)+'/'+x.uri+'  ->  '+x.action));
  }catch(e){}
});" 2>/dev/null)

if [ -n "$colisiones" ]; then
    falla "Hay rutas NO-Filament bajo /$panel:"
    echo "$colisiones"
    nota "Cambia el path del panel o mueve esas rutas."
else
    ok "Ninguna ruta del front invade /$panel."
fi

# ===========================================================================
titulo "8. Guard de autenticación"
# ===========================================================================
guard=$(grep -rhoE -e "\->authGuard\(['\"][^'\"]*['\"]\)" app/Providers/Filament/*.php 2>/dev/null | grep -oE "['\"][^'\"]*['\"]" | tr -d "\"'")
if [ -n "$guard" ]; then
    nota "Filament usa el guard: $guard"
else
    nota "Filament usa el guard por defecto (web), el mismo que Inertia."
    nota "Si un usuario del front no debe entrar al panel, implementa"
    nota "FilamentUser::canAccessPanel() en tu modelo User."
fi
if [ -f app/Models/User.php ] && grep -q "canAccessPanel" app/Models/User.php; then
    ok "User implementa canAccessPanel()."
else
    aviso "User NO implementa canAccessPanel(): cualquier usuario logueado entra a /$panel."
fi

# ===========================================================================
titulo "RESUMEN"
# ===========================================================================
echo -e "  Fallas: ${BOLD}$problemas${OFF}    Avisos: ${BOLD}$avisos${OFF}"
if [ "$problemas" -eq 0 ] && [ "$avisos" -eq 0 ]; then
    echo -e "\n  Stack limpio. Ejecuta además las pruebas de navegador del README."
else
    echo -e "\n  Revisa los puntos marcados arriba antes de seguir."
fi
echo ""