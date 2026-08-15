<template>
    <header class="header" ref="headerRef">
        <div class="container">
            <div class="header__inner">
                <!-- Logo -->
                <div class="header__logo">
                    <img
                        src="/images/logo.svg"
                        alt="Steel Ingeniería"
                        width="160"
                        height="70"
                        loading="eager"
                        decoding="async"
                        class="logo"
                    />
                </div>

                <!-- Nav Desktop (visible en lg+) -->
                <nav class="header__nav" aria-label="Navegación principal">
                    <Link href="/" class="nav-link">Principal</Link>
                    <Link href="/servicios" class="nav-link">Servicios</Link>
                    <Link
                        href="/soluciones-de-arrastre-con-master-move"
                        class="nav-link"
                    >
                        Soluciones de Arrastre <br />con MasterMover®
                    </Link>
                    <Link
                        href="/soluciones-de-movilidad-con-tente"
                        class="nav-link"
                    >
                        Soluciones de Movilidad <br />con TENTE®
                    </Link>
                    <Link href="/proyectos" class="nav-link">Proyectos</Link>
                    <Link href="/contactenos" class="nav-link"
                        >Contáctenos</Link
                    >
                </nav>

                <!-- Hamburger button (visible en md-) -->
                <button
                    class="header__burger"
                    @click="menuOpen = !menuOpen"
                    :aria-expanded="menuOpen"
                    aria-label="Toggle menu"
                >
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                </button>
            </div>

            <!-- Nav Mobile (visible en md-) -->
            <nav
                v-show="menuOpen"
                class="header__nav-mobile"
                aria-label="Navegación móvil"
            >
                <Link href="/" class="nav-link-mobile" @click="menuOpen = false"
                    >Principal</Link
                >
                <Link
                    href="/servicios"
                    class="nav-link-mobile"
                    @click="menuOpen = false"
                    >Servicios</Link
                >
                <Link
                    href="/soluciones-de-arrastre-con-master-move"
                    class="nav-link-mobile"
                    @click="menuOpen = false"
                >
                    Soluciones de Arrastre con MasterMover®
                </Link>
                <Link
                    href="/soluciones-de-movilidad-con-tente"
                    class="nav-link-mobile"
                    @click="menuOpen = false"
                >
                    Soluciones de Movilidad con TENTE®
                </Link>
                <Link
                    href="/proyectos"
                    class="nav-link-mobile"
                    @click="menuOpen = false"
                    >Proyectos</Link
                >
                <Link
                    href="/contactenos"
                    class="nav-link-mobile"
                    @click="menuOpen = false"
                >
                    Contáctenos
                </Link>
            </nav>
        </div>
    </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Link } from "@inertiajs/vue3";
import gsap from "gsap";

const headerRef = ref(null);
let scrollTween = null;

const menuOpen = ref(false);

onMounted(() => {
    // Escuchar evento de scroll
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
    if (scrollTween) scrollTween.kill(); // Limpiar tween
});

const handleScroll = () => {
    const scrollY = window.scrollY;
    const threshold = 50; // A partir de 50px de scroll

    if (scrollY > threshold) {
        // Animar fondo cuando scrollea más de 50px
        gsap.to(headerRef.value, {
            backgroundColor: "rgba(0, 0, 0, 0.5)",
            duration: 0.3,
            overwrite: "auto",
        });
    } else {
        // Volver al fondo original
        gsap.to(headerRef.value, {
            backgroundColor: "transparent",
            duration: 0.3,
            overwrite: "auto",
        });
    }
};
</script>

<style lang="scss" scoped>
.header {
    background: transparent; // Inicial transparente
    color: $color-white;
    padding: $spacing-md 0;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: $z-sticky;
    // box-shadow: $shadow-sm;
    contain: layout style paint;
    transition: box-shadow 0.3s ease; // Mantén transition para box-shadow
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

    @include respond-to("sm") {
        width: 130px;
        height: 60px;
    }
}

// ============ NAV DESKTOP ============
.header__nav {
    display: flex;
    gap: $spacing-lg;
    // flex: 1;
    align-items: flex-start;

    // Oculta en tablet y mobile
    @include respond-to("lg") {
        display: none;
    }
}

.nav-link {
    color: $color-white;
    font-family: $font-sans;
    font-weight: $font-weight-medium;
    font-size: $font-size-sm;
    transition: color $transition-fast;
    white-space: nowrap;
    text-align: center;
    line-height: $line-height-tight;
    // Texto más pequeño en links largos
    &:hover {
        color: $color-primary-light;
    }
}

// ============ HAMBURGER BUTTON ============
.header__burger {
    display: none;
    flex-direction: column;
    gap: 5px;
    background: transparent;
    border: none;
    cursor: pointer;
    flex-shrink: 0;

    // Visible en tablet y mobile
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

    // Animación del hamburger
    .header__burger[aria-expanded="true"] & {
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

// ============ NAV MOBILE ============
.header__nav-mobile {
    display: none;
    flex-direction: column;
    gap: $spacing-sm;
    padding: $spacing-md $spacing-sm;
    background: darken($color-secondary, 5%);
    border-top: 1px solid rgba($color-white, 0.1);
    animation: slideDown $transition-base ease-out;

    // Visible en tablet y mobile
    @include respond-to("md") {
        display: flex;
    }
}

.nav-link-mobile {
    color: $color-white;
    font-family: $font-sans;
    font-weight: $font-weight-medium;
    font-size: $font-size-base;
    padding: $spacing-sm 0;
    transition: color $transition-fast;
    display: block;
    text-align: left;

    &:hover {
        color: $color-primary-light;
    }
}

// Animación
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
</style>
