<template>
    <header class="header" ref="headerRef">
        <div class="container">
            <div class="header__inner">
                <!-- Logo -->
                <div class="header__logo">
                    <Link href="/" aria-label="Ir al inicio">
                        <img
                            src="/images/logo.svg"
                            alt="Steel Ingeniería"
                            width="160"
                            height="70"
                            loading="eager"
                            decoding="async"
                            class="logo"
                        />
                    </Link>
                </div>

                <!-- Nav escritorio -->
                <nav class="header__nav" aria-label="Navegación principal">
                    <ul class="nav-list">
                        <li
                            v-for="(item, index) in navItems"
                            :key="item.href"
                            class="nav-item"
                            :class="{
                                'nav-item--open': openIndex === index,
                                'nav-item--activo': esActivoConHijos(item),
                            }"
                            @mouseenter="item.children && abrir(index)"
                            @mouseleave="item.children && cerrar()"
                        >
                            <Link
                                :href="item.href"
                                class="nav-link"
                                :aria-current="
                                    esActivo(item.href) ? 'page' : undefined
                                "
                                :aria-haspopup="
                                    item.children ? 'true' : undefined
                                "
                                :aria-expanded="
                                    item.children
                                        ? String(openIndex === index)
                                        : undefined
                                "
                                @focus="item.children ? abrir(index) : cerrar()"
                            >
                                <span
                                    v-for="(linea, i) in item.lines"
                                    :key="i"
                                    class="nav-link__linea"
                                >
                                    {{ linea }}
                                </span>

                                <svg
                                    v-if="item.children"
                                    class="nav-link__chevron"
                                    viewBox="0 0 20 20"
                                    aria-hidden="true"
                                    focusable="false"
                                >
                                    <path
                                        d="M5 7.5 10 12.5 15 7.5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </Link>

                            <!-- Submenu -->
                            <ul v-if="item.children" class="submenu">
                                <li
                                    v-for="hijo in item.children"
                                    :key="hijo.href"
                                    class="submenu__item"
                                >
                                    <Link
                                        :href="hijo.href"
                                        class="submenu__link"
                                        :class="{
                                            'submenu__link--activo': esActivo(
                                                hijo.href,
                                            ),
                                        }"
                                        :aria-current="
                                            esActivo(hijo.href)
                                                ? 'page'
                                                : undefined
                                        "
                                        @focus="abrir(index)"
                                    >
                                        {{ hijo.label }}
                                    </Link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <!-- Boton hamburguesa -->
                <button
                    class="header__burger"
                    :class="{ 'header__burger--open': menuOpen }"
                    @click="menuOpen = !menuOpen"
                    :aria-expanded="String(menuOpen)"
                    aria-controls="nav-movil"
                    aria-label="Abrir menú"
                >
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                </button>
            </div>

            <!-- Nav movil: los hijos se despliegan como acordeon -->
            <nav
                v-show="menuOpen"
                id="nav-movil"
                class="header__nav-mobile"
                aria-label="Navegación móvil"
            >
                <div
                    v-for="(item, index) in navItems"
                    :key="item.href"
                    class="nav-movil__grupo"
                >
                    <div class="nav-movil__fila">
                        <Link
                            v-if="!item.children"
                            :href="item.href"
                            class="nav-link-mobile"
                            :class="{
                                'nav-link-mobile--activo':
                                    esActivoConHijos(item),
                            }"
                            :aria-current="
                                esActivo(item.href) ? 'page' : undefined
                            "
                            @click="cerrarTodo"
                        >
                            {{ item.label }}
                        </Link>

                        <button
                            v-else
                            :href="item.href"
                            class="nav-link-mobile"
                            :class="{
                                'nav-link-mobile--activo':
                                    esActivoConHijos(item),
                            }"
                            :aria-current="
                                esActivo(item.href) ? 'page' : undefined
                            "
                            @click="toggleMovil(index)"
                        >
                            {{ item.label }}
                        </button>

                        <!-- Boton separado del enlace: asi el padre sigue
                             navegando y el desplegable se controla aparte. -->
                        <button
                            v-if="item.children"
                            class="nav-movil__toggle"
                            @click="toggleMovil(index)"
                            :aria-expanded="String(movilAbierto === index)"
                            :aria-label="`Ver opciones de ${item.label}`"
                        >
                            <svg
                                viewBox="0 0 20 20"
                                aria-hidden="true"
                                focusable="false"
                            >
                                <path
                                    d="M5 7.5 10 12.5 15 7.5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </button>
                    </div>

                    <div
                        v-if="item.children"
                        v-show="movilAbierto === index"
                        class="nav-movil__hijos"
                    >
                        <Link
                            v-for="hijo in item.children"
                            :key="hijo.href"
                            :href="hijo.href"
                            class="nav-link-mobile nav-link-mobile--hijo"
                            :class="{
                                'nav-link-mobile--activo': esActivo(hijo.href),
                            }"
                            :aria-current="
                                esActivo(hijo.href) ? 'page' : undefined
                            "
                            @click="cerrarTodo"
                        >
                            {{ hijo.label }}
                        </Link>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue";
import { Link } from "@inertiajs/vue3";
import gsap from "gsap";

/**
 * Estructura del menu.
 *
 * lines permite el salto de linea del diseno sin recurrir a v-html:
 * cada entrada es un span dentro del mismo enlace, asi el texto sigue
 * siendo un unico enlace para el rastreador y para un lector de pantalla.
 *
 * Cuando conectemos el menu administrable, este arreglo se reemplaza por
 * usePage().props.layout.headerMenu sin tocar el resto del componente.
 */

const page = usePage();
/**
 * Un enlace esta activo si la ruta coincide exacto, o si la ruta actual
 * cuelga de el. La barra en el startsWith evita que /servicios marque
 * como activo a /servicios-industriales, que es otra pagina distinta.
 */
const esActivo = (href) => {
    const actual = page.url.split("?")[0].replace(/\/$/, "") || "/";
    const destino = href.replace(/\/$/, "") || "/";

    if (destino === "/") {
        return actual === "/";
    }

    return actual === destino || actual.startsWith(`${destino}/`);
};

// El padre se marca tambien cuando la pagina actual es uno de sus hijos.
const esActivoConHijos = (item) => {
    if (esActivo(item.href)) {
        return true;
    }

    return item.children?.some((hijo) => esActivo(hijo.href)) ?? false;
};
const navItems = [
    { label: "Principal", lines: ["Principal"], href: "/" },
    {
        label: "Servicios",
        lines: ["Servicios"],
        href: "#",
        children: [
            {
                label: "Fabricaciones",
                href: "/servicios/fabricacion-metalmecanica",
            },
            {
                label: "Montaje y Mantenimiento Metálico",
                href: "/servicios/montaje-y-mantenimiento-metalico",
            },
            {
                label: "Ingeniería y Diseño",
                href: "/servicios/ingenieria-y-diseno",
            },
        ],
    },
    {
        label: "Soluciones de Arrastre con MasterMover®",
        lines: ["Soluciones de Arrastre", "con MasterMover®"],
        href: "/soluciones/master-mover/soluciones-de-arrastre",
    },
    {
        label: "Soluciones de Movilidad con TENTE®",
        lines: ["Soluciones de Movilidad", "con TENTE®"],
        href: "/soluciones/tente/soluciones-de-movilidad-con-tente",
    },
    { label: "Proyectos", lines: ["Proyectos"], href: "/proyectos" },
    { label: "Contáctenos", lines: ["Contáctenos"], href: "/contactenos" },
];

const headerRef = ref(null);
const menuOpen = ref(false);
const openIndex = ref(null);
const movilAbierto = ref(null);

const abrir = (index) => {
    openIndex.value = index;
};

const cerrar = () => {
    openIndex.value = null;
};

const toggleMovil = (index) => {
    movilAbierto.value = movilAbierto.value === index ? null : index;
};

const cerrarTodo = () => {
    menuOpen.value = false;
    movilAbierto.value = null;
    openIndex.value = null;
};

// Escape cierra el desplegable sin necesidad de mover el mouse.
// Es lo que espera cualquiera que navegue con teclado.
const handleKeydown = (event) => {
    if (event.key === "Escape") {
        cerrarTodo();
    }
};

// Si el foco sale del nav por tabulacion, el submenu se cierra solo.
const handleFocusOut = (event) => {
    const nav = event.currentTarget;

    if (!nav.contains(event.relatedTarget)) {
        cerrar();
    }
};

let scrollTween = null;

const handleScroll = () => {
    const threshold = 50;

    gsap.to(headerRef.value, {
        backgroundColor:
            window.scrollY > threshold ? "rgba(0, 0, 0, 0.5)" : "transparent",
        duration: 0.3,
        overwrite: "auto",
    });
};

onMounted(() => {
    // passive: true le avisa al navegador que este handler no va a
    // cancelar el scroll, y le permite no esperar a que termine.
    window.addEventListener("scroll", handleScroll, { passive: true });
    document.addEventListener("keydown", handleKeydown);

    headerRef.value
        ?.querySelector(".header__nav")
        ?.addEventListener("focusout", handleFocusOut);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
    document.removeEventListener("keydown", handleKeydown);
    if (scrollTween) scrollTween.kill();
});
</script>

<style lang="scss" scoped>
.header {
    background: transparent;
    color: $color-white;
    padding: $spacing-md 0;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: $z-sticky;
    contain: layout style;
    transition: box-shadow 0.3s ease;
}

.container {
    max-width: $max-width-container;
    margin: 0 auto;
    padding: 0 $spacing-md;

    @include respond-to("md") {
        padding: 0 $spacing-sm;
    }
}

.header__inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: $spacing-lg;
}

// ============ LOGO ============
.header__logo {
    display: flex;
    align-items: center;
    flex-shrink: 0;
}

.logo {
    width: 160px;
    height: 70px;
    object-fit: contain;

    @include respond-to("md") {
        width: 130px;
        height: 60px;
    }
}

// ============ NAV ESCRITORIO ============
.header__nav {
    @include respond-to("lg") {
        display: none;
    }
}

.nav-list {
    display: flex;
    align-items: flex-start;
    gap: $spacing-lg;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-item {
    position: relative;

    // El submenu arranca pegado al borde inferior del item, sin hueco.
    // Un espacio entre el padre y el desplegable hace que se cierre al
    // intentar llegar con el mouse.
    &--open .submenu,
    &:focus-within .submenu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        pointer-events: auto;
    }

    &--open .nav-link__chevron,
    &:focus-within .nav-link__chevron {
        transform: rotate(180deg);
    }
}

.nav-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: $color-white;
    font-family: $font-sans;
    font-weight: $font-weight-medium;
    font-size: $font-size-sm;
    line-height: $line-height-tight;
    white-space: nowrap;
    text-align: center;
    transition: color $transition-fast;
    padding-bottom: $spacing-md;
    margin-bottom: -$spacing-md;

    &:hover,
    &:focus-visible {
        color: $color-primary-light;
    }

    &__linea {
        display: block;
    }

    &__chevron {
        width: 14px;
        height: 14px;
        margin-top: 2px;
        transition: transform $transition-fast;
    }
}

// Un item con hijos alinea el texto y la flecha en la misma linea
// cuando el texto ocupa una sola linea.
.nav-item .nav-link:has(.nav-link__chevron) {
    flex-direction: row;
    align-items: center;
    gap: 4px;
}

// ============ SUBMENU ============
.submenu {
    position: absolute;
    top: 150%;
    left: -40%;
    transform: translate(-40%, 8px);
    min-width: 260px;
    margin: 0;
    padding: $spacing-sm 0;
    list-style: none;

    background: rgba(38, 38, 38, 0.95);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: $radius-md;
    box-shadow: $shadow-lg;

    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition:
        opacity $transition-fast,
        transform $transition-fast,
        visibility $transition-fast;

    z-index: $z-dropdown;
}

.submenu__item + .submenu__item .submenu__link {
    border-top: 1px solid rgba($color-white, 0.12);
}

.submenu__link {
    display: block;
    padding: $spacing-md $spacing-lg;
    color: $color-white;
    font-family: $font-sans;
    font-size: $font-size-sm;
    font-weight: $font-weight-normal;
    line-height: 1.35;
    white-space: normal;
    transition: color $transition-fast;

    &:hover,
    &:focus-visible {
        color: $color-primary-light;
    }
}

// ============ HAMBURGUESA ============
.header__burger {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: transparent;
    border: none;
    cursor: pointer;
    flex-shrink: 0;
    padding: $spacing-xs;

    @include respond-to("lg") {
        display: flex;
    }
}

.burger-line {
    width: 24px;
    height: 2px;
    background: $color-white;
    border-radius: 2px;
    transition: all $transition-base;

    .header__burger--open & {
        &:nth-child(1) {
            transform: rotate(45deg) translateY(10px);
        }

        &:nth-child(2) {
            opacity: 0;
        }

        &:nth-child(3) {
            transform: rotate(-45deg) translateY(-10px);
        }
    }
}
.nav-item--activo .nav-link {
    color: $color-primary-light;

    // Subrayado que no desplaza nada al aparecer.
    &::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: -0.5rem;
        height: 2px;
        background: $color-primary-light;
        border-radius: 2px;
    }
}

.submenu__link--activo {
    color: $color-primary-light;
    font-weight: $font-weight-semibold;
}

// ============ NAV MOVIL ============
// Mismo punto de corte que el nav de escritorio: si uno se oculta en
// 1024 y el otro aparece en 768, entre esos dos anchos no se muestra
// ninguno de los dos y el boton no despliega nada.
.header__nav-mobile {
    display: none;
    flex-direction: column;
    padding: $spacing-md $spacing-sm;
    background: rgba(26, 26, 26, 0.97);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-top: 1px solid rgba($color-white, 0.1);
    border-radius: 0 0 $radius-md $radius-md;
    animation: slideDown $transition-base ease-out;

    @include respond-to("lg") {
        display: flex;
    }
}

.nav-movil__grupo + .nav-movil__grupo {
    border-top: 1px solid rgba($color-white, 0.08);
}

.nav-movil__fila {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: $spacing-sm;
}

.nav-movil__toggle {
    display: flex;
    align-items: center;
    justify-content: center;
    // 44px es el minimo recomendado para un objetivo tactil.
    width: 44px;
    height: 44px;
    background: transparent;
    border: none;
    color: $color-white;
    cursor: pointer;

    svg {
        width: 18px;
        height: 18px;
        transition: transform $transition-fast;
    }

    &[aria-expanded="true"] svg {
        transform: rotate(180deg);
    }
}

.nav-movil__hijos {
    padding-left: $spacing-md;
    padding-bottom: $spacing-sm;
    border-left: 2px solid rgba($color-primary-light, 0.4);
    margin-left: $spacing-xs;
}

.nav-link-mobile {
    flex: 1;
    color: $color-white;
    font-family: $font-sans;
    font-weight: $font-weight-medium;
    font-size: $font-size-base;
    padding: $spacing-sm 0;
    transition: color $transition-fast;
    display: block;
    text-align: left;

    &:hover,
    &:focus-visible {
        color: $color-primary-light;
    }

    &--hijo {
        font-weight: $font-weight-normal;
        font-size: $font-size-sm;
        opacity: 0.9;
    }
}

.nav-link-mobile--activo {
    color: $color-primary-light;
    font-weight: $font-weight-semibold;
}

.nav-link-mobile.nav-link-mobile--activo {
    color: $color-primary-light;
    font-weight: $font-weight-semibold;
    opacity: 1;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (prefers-reduced-motion: reduce) {
    .header__nav-mobile {
        animation: none;
    }

    .submenu,
    .nav-link__chevron,
    .burger-line,
    .nav-movil__toggle svg {
        transition: none;
    }
}
</style>
