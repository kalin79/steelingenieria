<template>
    <footer class="footerSteel">
        <div class="container">
            <div class="footerSteel__layout">
                <!-- Columna marca -->
                <div class="footerBrand">
                    <Link href="/" class="footerBrand__logo">
                        <img
                            src="/images/logofooter.svg"
                            alt="STEEL Ingeniería"
                        />
                    </Link>

                    <ul class="footerSocial">
                        <li v-for="red in redes" :key="red.nombre">
                            <a
                                :href="red.url"
                                target="_blank"
                                rel="noopener noreferrer"
                                :aria-label="red.nombre"
                            >
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path :d="red.icono" />
                                </svg>
                            </a>
                        </li>
                    </ul>

                    <ul class="footerContacto">
                        <li>
                            <a :href="`tel:${telefono.replace(/\D/g, '')}`">
                                <img src="/images/fono.svg" />
                                {{ telefono }}
                            </a>
                        </li>
                        <li>
                            <a :href="`mailto:${email}`">
                                <img src="/images/email.svg" />
                                {{ email }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Columnas de enlaces -->
                <nav
                    v-for="col in columnas"
                    :key="col.titulo"
                    class="footerCol"
                    :aria-label="col.titulo"
                >
                    <h3 class="footerCol__titulo">{{ col.titulo }}</h3>
                    <ul class="footerCol__lista">
                        <li v-for="item in col.items" :key="item.label">
                            <Link
                                v-if="item.href.startsWith('/')"
                                :href="item.href"
                            >
                                {{ item.label }}
                            </Link>
                            <a
                                v-else
                                :href="item.href"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                {{ item.label }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="footerSteel__bottom">
            <div class="container">
                <p>
                    Copyright &copy; STEEL INGENIERÍA {{ anio }}. Todos los
                    derechos reservados.
                </p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

// Año dinámico: evita que el footer quede desactualizado en enero.
const anio = new Date().getFullYear();

const telefono = "(01) 469 8186";
const email = "ventas@steelingenieria.com";

// Paths SVG inline: sin dependencia de librería de iconos ni requests extra.
const ICONOS = {
    facebook:
        "M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z",
    linkedin:
        "M6.94 5a2 2 0 1 1-4-.002 2 2 0 0 1 4 .002zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91l.04-1.68z",
    telefono:
        "M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1.02l-2.2 2.2z",
    email: "M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z",
};

const redes = [
    {
        nombre: "Facebook",
        url: "https://www.facebook.com/steelingenieria",
        icono: ICONOS.facebook,
    },
    {
        nombre: "LinkedIn",
        url: "https://www.linkedin.com/company/steelingenieria",
        icono: ICONOS.linkedin,
    },
];

/*
 * Estructura de datos en vez de markup repetido: agregar un enlace o una
 * columna es tocar este array, no el template. Si mañana el menú viene del
 * backend, se reemplaza por una prop sin cambiar nada del render.
 */
const columnas = [
    {
        titulo: "Páginas",
        items: [
            { label: "Quienes Somos", href: "/quienes-somos" },
            { label: "Proyectos", href: "/proyectos" },
            { label: "Contáctenos", href: "/contacto" },
        ],
    },
    {
        titulo: "Servicios de Ingeniería",
        items: [
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
        titulo: "Soluciones de Movilidad Industrial",
        items: [
            {
                label: "Arrastradores Eléctricos MASTERMOVER",
                href: "/soluciones/master-mover/soluciones-de-arrastre",
            },
            { label: "Ruedas TENTE", href: "/soluciones/tente/supermercados" },
        ],
    },
];
</script>

<style lang="scss" scoped>
.footerSteel {
    --ft-bg: #253773; // azul sólido, un solo tono en todo el footer
    --ft-title: #8ca3e6;
    --ft-text: #ffffff;
    --ft-muted: #9fb0e8;
    --ft-line: rgba(255, 255, 255, 0.12);
    --ft-chip: rgba(255, 255, 255, 0.1);

    background: var(--ft-bg);
    color: var(--ft-text);

    &__layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2.5rem;
        padding: 3rem 0;

        @media screen and (min-width: 768px) {
            grid-template-columns: repeat(2, 1fr);
            gap: 3rem 2rem;
        }
        // 4 columnas: marca + 3 bloques de enlaces
        @media screen and (min-width: 992px) {
            grid-template-columns: 1.2fr 1fr 1.3fr 1.3fr;
            gap: 2rem;
            padding: 3rem 0 3rem;
        }
    }

    &__bottom {
        border-top: 1px solid var(--ft-line);
        p {
            margin: 0;
            padding: 1.15rem 0;
            text-align: center;
            font-size: 1rem;
            font-family: $font-sans;
            font-weight: 500;
            color: #459dd7;
        }
    }
}

/* ---------- Columna de marca ---------- */
.footerBrand {
    min-width: 0;

    &__logo {
        display: inline-block;
        margin-bottom: 0.75rem;
        width: 100%;
        @media screen and (min-width: 992px) {
            width: auto;
        }
        img {
            height: auto;
            width: 160px;
            display: block;
            margin: auto;
            @media screen and (min-width: 992px) {
                margin: 0;
            }
        }
    }
}

.footerSocial {
    list-style: none;
    margin: 0 0 1.75rem;
    padding: 0;
    display: flex;
    gap: 0.6rem;
    justify-content: center;
    @media screen and (min-width: 992px) {
        justify-content: flex-start;
    }
    a {
        width: 34px;
        height: 34px;
        border-radius: 6px;
        background: #459dd7;
        display: grid;
        place-items: center;
        transition:
            background 0.25s ease,
            transform 0.25s ease;

        svg {
            width: 16px;
            height: 16px;
            fill: #253773;
        }
        &:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-2px);
        }
    }
}

.footerContacto {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 0.9rem;

    a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-family: $font-sans;
        color: var(--ft-text);
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.2s ease;
        &:hover {
            color: var(--ft-title);
        }
    }

    &__icono {
        width: 30px;
        height: 30px;
        flex-shrink: 0;
        border-radius: 50%;
        border: 1px solid var(--ft-line);
        display: grid;
        place-items: center;
        svg {
            width: 15px;
            height: 15px;
            fill: #fff;
        }
    }
}

/* ---------- Columnas de enlaces ---------- */
.footerCol {
    min-width: 0;
    // border: 1px solid red;

    @media screen and (min-width: 992px) {
        margin-top: 5.5rem;
    }
    &__titulo {
        margin: 0 0 1.35rem;
        font-family: $font-archia;
        font-size: 1rem;
        font-weight: 500;
        color: #459dd7;
        line-height: 1.35;
    }

    &__lista {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 0.7rem;

        li {
            position: relative;
            padding-left: 1rem;

            // Bullet propio: el marker nativo no se alinea bien con texto de 2 líneas
            &::before {
                content: "";
                position: absolute;
                left: 0;
                top: 0.55em;
                width: 4px;
                height: 4px;
                border-radius: 50%;
                background: var(--ft-text);
            }
        }

        a {
            color: white;
            font-family: $font-sans;
            text-decoration: none;
            font-size: 1rem;
            line-height: 1.4;
            transition: color 0.2s ease;
            &:hover {
                color: var(--ft-title);
            }
        }
    }
}
</style>
